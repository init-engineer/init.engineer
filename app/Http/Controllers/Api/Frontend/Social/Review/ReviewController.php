<?php

namespace App\Http\Controllers\Api\Frontend\Social\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Frontend\Social\Review\ReviewRequest;
use App\Http\Transformers\IlluminatePaginatorAdapter;
use App\Http\Transformers\Social\ReviewTransformer;
use App\Repositories\Frontend\Social\CardsRepository;
use App\Repositories\Frontend\Social\ReviewRepository;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

/**
 * Class ReviewController.
 */
class ReviewController extends Controller
{
    /**
     * @var Manager
     */
    protected $fractal;

    /**
     * @var CardsRepository
     */
    protected $cardsRepository;

    /**
     * @var ReviewRepository
     */
    protected $reviewRepository;

    /**
     * CardsController constructor.
     *
     * @param Manager $fractal
     * @param CardsRepository $cardsRepository
     * @param ReviewRepository $reviewRepository
     */
    public function __construct(
        Manager $fractal,
        CardsRepository $cardsRepository,
        ReviewRepository $reviewRepository
    ) {
        $this->fractal = $fractal;
        $this->cardsRepository = $cardsRepository;
        $this->reviewRepository = $reviewRepository;
    }

    /**
     * @param ReviewRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function review(ReviewRequest $request)
    {
        $paginator = $this->cardsRepository->getUnactivePaginated();
        $cards = new Collection($paginator->items(), new ReviewTransformer());
        $cards->setPaginator(new IlluminatePaginatorAdapter($paginator));
        $response = $this->fractal->createData($cards);
        $response = $response->toArray();
        foreach ($response['data'] as $key => $value) {
            $review = $this->reviewRepository->findByCardId($value['id'], $request->user()->id);
            $response['data'][$key]['review'] = $review ? $review->point : 0;
        }

        return response()->json($response);
    }
}
