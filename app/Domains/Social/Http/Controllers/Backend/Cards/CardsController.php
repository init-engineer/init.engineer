<?php

namespace App\Domains\Social\Http\Controllers\Backend\Cards;

use App\Domains\Social\Http\Requests\Backend\Cards\DeleteCardsRequest;
use App\Domains\Social\Http\Requests\Backend\Cards\EditCardsRequest;
use App\Domains\Social\Http\Requests\Backend\Cards\StoreCardsRequest;
use App\Domains\Social\Http\Requests\Backend\Cards\UpdateCardsRequest;
use App\Domains\Social\Jobs\Publish\DiscordPublishJob;
use App\Domains\Social\Jobs\Publish\FacebookPublishJob;
use App\Domains\Social\Jobs\Publish\PlurkPublishJob;
use App\Domains\Social\Jobs\Publish\TelegramPublishJob;
use App\Domains\Social\Jobs\Publish\TumblrPublishJob;
use App\Domains\Social\Jobs\Publish\TwitterPublishJob;
use App\Domains\Social\Models\Cards;
use App\Domains\Social\Models\Platform;
use App\Domains\Social\Services\CardsService;
use App\Http\Controllers\Controller;

/**
 * Class CardsController.
 */
class CardsController extends Controller
{
    /**
     * @var CardsService
     */
    protected $cardsService;

    /**
     * CardsController constructor.
     *
     * @param CardsService $cardsService
     */
    public function __construct(CardsService $cardsService)
    {
        $this->cardsService = $cardsService;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.social.cards.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.social.cards.create');
    }

    /**
     * @param StoreCardsRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(StoreCardsRequest $request)
    {
        $cards = $this->cardsService->store($request->validated());

        return redirect()->route('admin.social.cards.show', $cards)->withFlashSuccess(__('The cards was successfully created.'));
    }

    /**
     * @param Cards $cards
     *
     * @return mixed
     */
    public function show(Cards $cards)
    {
        return view('backend.social.cards.show')
            ->with('cards', $cards);
    }

    /**
     * @param EditCardsRequest $request
     * @param Cards $cards
     *
     * @return mixed
     */
    public function edit(EditCardsRequest $request, Cards $cards)
    {
        return view('backend.social.cards.edit')
            ->with('cards', $cards);
    }

    /**
     * @param Cards $cards
     *
     * @return mixed
     * @throws \Throwable
     */
    public function platform(Cards $cards)
    {
        /**
         * 先把需要發表的社群平台抓出來
         */
        $platforms = Platform::where('action', Platform::ACTION_PUBLISH)
            ->active()
            ->get();

        /**
         * 判斷每個社群平台是否已經發表，如果還沒有發表的就新增 Job 排程
         */
        foreach ($platforms as $platform) {
            if ($cards->platformCards->where('active', 1)->where('platform_id', $platform->id)->count() === 0) {
                switch ($platform->type) {
                    /**
                     * 丟給負責發表文章到 Facebook 的 Job
                     */
                    case Platform::TYPE_FACEBOOK:
                        dispatch(new FacebookPublishJob($cards, $platform))->onQueue('highest');
                        break;

                    /**
                     * 丟給負責發表文章到 Twitter 的 Job
                     */
                    case Platform::TYPE_TWITTER:
                        dispatch(new TwitterPublishJob($cards, $platform))->onQueue('highest');
                        break;

                    /**
                     * 丟給負責發表文章到 Plurk 的 Job
                     */
                    case Platform::TYPE_PLURK:
                        dispatch(new PlurkPublishJob($cards, $platform))->onQueue('highest');
                        break;

                    /**
                     * 丟給負責發表文章到 Discord 的 Job
                     */
                    case Platform::TYPE_DISCORD:
                        dispatch(new DiscordPublishJob($cards, $platform))->onQueue('highest');
                        break;

                    /**
                     * 丟給負責發表文章到 Tumblr 的 Job
                     */
                    case Platform::TYPE_TUMBLR:
                        dispatch(new TumblrPublishJob($cards, $platform))->onQueue('highest');
                        break;

                    /**
                     * 丟給負責發表文章到 Telegram 的 Job
                     */
                    case Platform::TYPE_TELEGRAM:
                        dispatch(new TelegramPublishJob($cards, $platform))->onQueue('highest');
                        break;

                    /**
                     * 其它並不在支援名單當中的社群
                     */
                    default:
                        /**
                         * 直接把資料寫入 Activity log 以便日後查核
                         */
                        activity('social cards - undefined publish')
                            ->performedOn($cards)
                            ->log(json_encode($cards));
                        break;
                }
            }
        }

        return redirect()->route('admin.social.cards.index')->withFlashSuccess(__('The cards was successfully updated.'));
    }

    /**
     * @param Cards $cards
     *
     * @return mixed
     * @throws \Throwable
     */
    public function notification(Cards $cards)
    {
        /**
         * 先把需要通知的社群平台抓出來
         */
        $platforms = Platform::where('action', Platform::ACTION_NOTIFICATION)
            ->active()
            ->get();

        /**
         * 判斷每個社群平台是否已經通知，如果還沒有通知的就新增 Job 排程
         */
        foreach ($platforms as $platform) {
            if ($cards->platformCards->where('active', 1)->where('platform_id', $platform->id)->count() === 0) {
                switch ($platform->type) {
                    /**
                     * 丟給負責發表文章到 Facebook 的 Job
                     */
                    case Platform::TYPE_FACEBOOK:
                        dispatch(new FacebookPublishJob($cards, $platform))->onQueue('highest');
                        break;

                    /**
                     * 丟給負責發表文章到 Twitter 的 Job
                     */
                    case Platform::TYPE_TWITTER:
                        dispatch(new TwitterPublishJob($cards, $platform))->onQueue('highest');
                        break;

                    /**
                     * 丟給負責發表文章到 Plurk 的 Job
                     */
                    case Platform::TYPE_PLURK:
                        dispatch(new PlurkPublishJob($cards, $platform))->onQueue('highest');
                        break;

                    /**
                     * 丟給負責發表文章到 Discord 的 Job
                     */
                    case Platform::TYPE_DISCORD:
                        dispatch(new DiscordPublishJob($cards, $platform))->onQueue('highest');
                        break;

                    /**
                     * 丟給負責發表文章到 Tumblr 的 Job
                     */
                    case Platform::TYPE_TUMBLR:
                        dispatch(new TumblrPublishJob($cards, $platform))->onQueue('highest');
                        break;

                    /**
                     * 丟給負責發表文章到 Telegram 的 Job
                     */
                    case Platform::TYPE_TELEGRAM:
                        dispatch(new TelegramPublishJob($cards, $platform))->onQueue('highest');
                        break;

                    /**
                     * 其它並不在支援名單當中的社群
                     */
                    default:
                        /**
                         * 直接把資料寫入 Activity log 以便日後查核
                         */
                        activity('social cards - undefined publish')
                            ->performedOn($cards)
                            ->log(json_encode($cards));
                        break;
                }
            }
        }

        return redirect()->route('admin.social.cards.index')->withFlashSuccess(__('The cards was successfully updated.'));
    }

    /**
     * @param UpdateCardsRequest $request
     * @param Cards $cards
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateCardsRequest $request, Cards $cards)
    {
        $this->cardsService->update($cards, $request->validated());

        return redirect()->route('admin.social.cards.show', $cards)->withFlashSuccess(__('The cards was successfully updated.'));
    }

    /**
     * @param DeleteCardsRequest $request
     * @param Cards $cards
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy(DeleteCardsRequest $request, Cards $cards)
    {
        $this->cardsService->delete($cards);

        return redirect()->route('admin.social.cards.deleted')->withFlashSuccess(__('The cards was successfully deleted.'));
    }
}
