<?php

namespace App\Domains\Social\Http\Controllers\Api\Cards;

use App\Domains\Social\Jobs\Publish\DiscordPublishJob;
use App\Domains\Social\Jobs\Publish\FacebookPublishJob;
use App\Domains\Social\Jobs\Publish\PlurkPublishJob;
use App\Domains\Social\Jobs\Publish\TelegramPublishJob;
use App\Domains\Social\Jobs\Publish\TumblrPublishJob;
use App\Domains\Social\Jobs\Publish\TwitterPublishJob;
use App\Domains\Social\Models\Cards;
use App\Domains\Social\Models\Platform;
use App\Domains\Social\Services\CardsService;
use App\Domains\Social\Services\ReviewService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class ReviewController.
 */
class ReviewController extends Controller
{
    /**
     * @var CardsService
     */
    protected $cardsService;

    /**
     * @var ReviewService
     */
    protected $reviewService;

    /**
     * ReviewController constructor.
     *
     * @param CardsService $cardsService
     * @param ReviewService $reviewService
     */
    public function __construct(CardsService $cardsService, ReviewService $reviewService)
    {
        $this->cardsService = $cardsService;
        $this->reviewService = $reviewService;
    }

    /**
     * @param Request $request
     * @param Cards $card
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function haveVoted(Request $request, Cards $card)
    {
        $voted = $this->reviewService->haveVoted($card, $request->user());
        if ($voted['voted'] || $request->user()->isAdmin()) {
            $voted['count'] = [
                'yes' => $this->reviewService->findYesByVoted($card),
                'no' => $this->reviewService->findNoByVoted($card),
            ];
        }

        return response()->json($voted, 200);
    }

    /**
     * @param Request $request
     * @param Cards $card
     * @param $status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function voting(Request $request, Cards $card, $status)
    {
        $voted = $this->reviewService->haveVoted($card, $request->user());
        if ($voted['voted']) {
            return response()->json([
                'voted' => true,
                'count' => [
                    'yes' => $this->reviewService->findYesByVoted($card),
                    'no' => $this->reviewService->findNoByVoted($card),
                ],
            ], 200);
        }

        /**
         * 如果投票的是管理者，並且投的是通過票
         * 那就需要附帶文章直接通過審核的決議
         */
        if ($request->user()->isAdmin() && (bool) $status) {
            /**
             * 將文章切換為已認證狀態
             */
            $model = $this->cardsService->mark($card, true);

            /**
             * 通知投稿者文章通過審核
             */
            $model->sendPublishNotification();

            /**
             * 先把需要發表的社群平台抓出來
             */
            $platforms = Platform::where('action', Platform::ACTION_PUBLISH)
                ->active()
                ->get();

            /**
             * 根據社群平台逐一發佈
             */
            foreach ($platforms as $platform) {
                switch ($platform->type) {
                    /**
                     * 丟給負責發表文章到 Facebook 的 Job
                     */
                    case Platform::TYPE_FACEBOOK:
                        dispatch(new FacebookPublishJob($model, $platform))->onQueue('highest');
                        break;

                    /**
                     * 丟給負責發表文章到 Twitter 的 Job
                     */
                    case Platform::TYPE_TWITTER:
                        dispatch(new TwitterPublishJob($model, $platform))->onQueue('highest');
                        break;

                    /**
                     * 丟給負責發表文章到 Plurk 的 Job
                     */
                    case Platform::TYPE_PLURK:
                        dispatch(new PlurkPublishJob($model, $platform))->onQueue('highest');
                        break;

                    /**
                     * 丟給負責發表文章到 Discord 的 Job
                     */
                    case Platform::TYPE_DISCORD:
                        dispatch(new DiscordPublishJob($model, $platform))->onQueue('highest');
                        break;

                    /**
                     * 丟給負責發表文章到 Tumblr 的 Job
                     */
                    case Platform::TYPE_TUMBLR:
                        dispatch(new TumblrPublishJob($model, $platform))->onQueue('highest');
                        break;

                    /**
                     * 丟給負責發表文章到 Telegram 的 Job
                     */
                    case Platform::TYPE_TELEGRAM:
                        dispatch(new TelegramPublishJob($model, $platform))->onQueue('highest');
                        break;

                    /**
                     * 其它並不在支援名單當中的社群
                     */
                    default:
                        /**
                         * 直接把資料寫入 Activity log 以便日後查核
                         */
                        activity('social cards - undefined publish')
                            ->performedOn($card)
                            ->log(json_encode($model));
                        break;
                }
            }
        }

        $this->reviewService->store([
            'model_id' => $request->user()->id,
            'card_id' => $card->id,
            'point' => ((bool) $status) ? 1 : -1,
        ]);

        return response()->json([
            'voted' => true,
            'count' => [
                'yes' => $this->reviewService->findYesByVoted($card),
                'no' => $this->reviewService->findNoByVoted($card),
            ],
        ], 200);
    }
}
