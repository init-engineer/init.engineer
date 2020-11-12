<?php

namespace App\Http\Controllers\Api\Frontend\Social\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Frontend\Social\Review\ReviewRequest;
use App\Http\Transformers\IlluminatePaginatorAdapter;
use App\Http\Transformers\Social\ReviewTransformer;
use App\Repositories\Frontend\Social\CardsRepository;
use Illuminate\Container\Container;
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
     * ReviewController constructor.
     *
     * @param Manager $fractal
     */
    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
    }

    /**
     * @param ReviewRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function review(ReviewRequest $request)
    {
        $cardsRepository = Container::getInstance()->make(CardsRepository::class);
        $paginator = $cardsRepository->getUnactivePaginated();
        $collection = new Collection($paginator->items(), new ReviewTransformer());
        $collection->setPaginator(new IlluminatePaginatorAdapter($paginator));
        $response = $this->fractal->createData($collection);
        $response = $response->toArray();
        foreach ($response['data'] as $key => $value) {
            $reviewRepository = Container::getInstance()->make(ReviewRepository::class);
            $review = $reviewRepository->findByCardId($value['id'], $request->user()->id);
            $response['data'][$key]['review'] = $review ? $review->point : 0;
        }

        return response()->json($response);
    }
}
