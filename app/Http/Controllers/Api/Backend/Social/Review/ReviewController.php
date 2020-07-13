<?php

namespace App\Http\Controllers\Api\Backend\Social\Review;

use App\Http\Controllers\Controller;

/**
 * Class ReviewController.
 */
class ReviewController extends Controller
{


    /**
     * @param ReviewRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ReviewRequest $request)
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
