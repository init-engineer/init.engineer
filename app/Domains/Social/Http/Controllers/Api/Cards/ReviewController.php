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
        $voted = $this->service->haveVoted($card, $request->user());
        if ($voted['voted'] || $request->user()->isAdmin()) {
            $voted['count'] = [
                'yes' => $this->service->findYesByVoted($card),
                'no' => $this->service->findNoByVoted($card),
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
        $this->service->store([
            'model_id' => $request->user()->id,
            'card_id' => $card->id,
            'point' => ((bool) $status) ? 1 : -1,
        ]);

        return response()->json([
            'voted' => true,
            'count' => [
                'yes' => $this->service->findYesByVoted($card),
                'no' => $this->service->findNoByVoted($card),
            ],
        ], 200);
    }
}
