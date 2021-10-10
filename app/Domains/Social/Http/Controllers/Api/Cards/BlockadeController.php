<?php

namespace App\Domains\Social\Http\Controllers\Api\Cards;

use App\Domains\Social\Events\Cards\ArticleCreated;
use App\Domains\Social\Events\Cards\PictureCreated;
use App\Domains\Social\Http\Requests\Api\Publish\PublishArticleRequest;
use App\Domains\Social\Http\Requests\Api\Publish\PublishPictureRequest;
use App\Domains\Social\Http\Requests\Api\Publish\PublishPlatformRequest;
use App\Domains\Social\Http\Resources\CardResource;
use App\Domains\Social\Models\Ads;
use App\Domains\Social\Models\Cards;
use App\Domains\Social\Services\AdsService;
use App\Domains\Social\Services\CardsService;
use App\Domains\Social\Services\Image\ImagesGenerator;
use App\Http\Controllers\Controller;
use Illuminate\Container\Container;

/**
 * Class BlockadeController.
 */
class BlockadeController extends Controller
{
    /**
     * @var CardsService
     */
    protected $service;

    /**
     * BlockadeController constructor.
     *
     * @param CardsService $service
     */
    public function __construct(CardsService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Cards $card
     */
    public function cards(Cards $card)
    {
        // ...
    }
}
