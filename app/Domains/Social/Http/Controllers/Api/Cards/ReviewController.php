<?php

namespace App\Domains\Social\Http\Controllers\Api\Cards;

use App\Domains\Social\Models\Cards;
use App\Domains\Social\Services\ReviewService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class ReviewController.
 */
class ReviewController extends Controller
{
    /**
     * @var ReviewService
     */
    protected $service;

    /**
     * ReviewController constructor.
     *
     * @param ReviewService $service
     */
    public function __construct(ReviewService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @param Cards $card
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function haveVoted(Request $request, Cards $card)
    {
        return response()->json([
            'haveVoted' => $this->service->haveVoted($card, $request->user()),
        ], 200);
    }
}
