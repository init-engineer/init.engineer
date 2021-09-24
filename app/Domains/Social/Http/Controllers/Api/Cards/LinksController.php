<?php

namespace App\Domains\Social\Http\Controllers\Api\Cards;

use App\Domains\Social\Http\Resources\LinkCollection;
use App\Domains\Social\Models\Cards;
use App\Http\Controllers\Controller;

/**
 * Class LinksController.
 */
class LinksController extends Controller
{
    /**
     * LinksController constructor.
     */
    public function __construct()
    {
        // Code ...
    }

    /**
     * @param Cards $card
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Cards $card)
    {
        return new LinkCollection($card->platformCards()->orderBy('platform_type', 'ASC')->paginate());
    }
}
