<?php

namespace App\Domains\Social\Http\Controllers\Api\Cards;

use App\Domains\Social\Http\Requests\Api\Publish\PublishArticleRequest;
use App\Domains\Social\Http\Requests\Api\Publish\PublishPictureRequest;
use App\Domains\Social\Http\Resources\CardResource;
use App\Domains\Social\Services\CardsService;
use App\Http\Controllers\Controller;

/**
 * Class PublishController.
 */
class PublishController extends Controller
{
    /**
     * @var CardsService
     */
    protected $service;

    /**
     * PublishController constructor.
     *
     * @param CardsService $service
     */
    public function __construct(CardsService $service)
    {
        $this->service = $service;
    }

    /**
     * @param PublishArticleRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function article(PublishArticleRequest $request)
    {
        dd($request->validated());

        /**
         * 整理圖片投稿資訊
         */
        $data = $request->validated();
        $data['model_id'] = $request->user()->id;
        $data['picture'] = [
            'local' => null, // 需要補上產生文章圖片的 service
            'storage' => null,
            'imgur' => null,
        ];

        /**
         * 將圖片投稿寫入
         */
        $card = $this->service->store($data);

        return new CardResource($card);
    }

    /**
     * @param PublishPictureRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function picture(PublishPictureRequest $request)
    {
        /**
         * 將圖片儲存到 Local 當中
         */
        $path = $request->file('picture')->store('public/cards/custom');
        $path = str_replace('public', 'storage', $path);

        /**
         * 整理圖片投稿資訊
         */
        $data = $request->validated();
        $data['model_id'] = $request->user()->id;
        $data['picture'] = [
            'local' => $path,
            'storage' => null,
            'imgur' => null,
        ];

        /**
         * 將圖片投稿寫入
         */
        $card = $this->service->store($data);

        return new CardResource($card);
    }
}
