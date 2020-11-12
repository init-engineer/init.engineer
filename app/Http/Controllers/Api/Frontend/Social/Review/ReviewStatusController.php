<?php

namespace App\Http\Controllers\Api\Frontend\Social\Review;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Frontend\Social\Review\ReviewSucceededRequest;
use App\Models\Social\Cards;
use League\Fractal\Manager;

/**
 * Class ReviewStatusController.
 */
class ReviewStatusController extends Controller
{
    /**
     * @var Manager
     */
    protected $fractal;

    /**
     * ReviewStatusController constructor.
     *
     * @param Manager $fractal
     */
    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
    }

    /**
     * @param ReviewSucceededRequest $request
     * @param Cards $id
     *
     * @return \Illuminate\Http\Response
     */
    public function succeeded(ReviewSucceededRequest $request, Cards $id)
    {
        if ($id->isActive()) {
            throw new GeneralException(__('exceptions.frontend.social.cards.review.card_is_active'));
        } else {
            if ($this->reviewRepository->findByCardId($id->id, $request->user()->id)) {
                throw new GeneralException(__('exceptions.frontend.social.cards.review.already_succeeded'));
            } else {
                $point = 1;
                $roles = ['user'];
                if ($request->user()->isAdmin()) {
                    $point += 99;
                    array_push($roles, 'administrator');
                    $this->backendCardsRepository->active($id);
                    $this->cardsService->publish($id);
                }
                if ($request->user()->isJuniorVIP()) {
                    $point += 1;
                    array_push($roles, 'junior vip');
                }
                if ($request->user()->isSeniorVIP()) {
                    $point += 2;
                    array_push($roles, 'senior vip');
                }
                if ($request->user()->isExpertVIP()) {
                    $point += 3;
                    array_push($roles, 'expert vip');
                }
                if ($request->user()->isLegendVIP()) {
                    $point += 4;
                    array_push($roles, 'legend vip');
                }

                if ($request->user()->isJuniorDonate()) {
                    $point += 1;
                    array_push($roles, 'junior donate');
                }
                if ($request->user()->isSeniorDonate()) {
                    $point += 2;
                    array_push($roles, 'senior donate');
                }
                if ($request->user()->isExpertDonate()) {
                    $point += 3;
                    array_push($roles, 'expert donate');
                }
                if ($request->user()->isLegendDonate()) {
                    $point += 4;
                    array_push($roles, 'legend donate');
                }

                if ($request->user()->isJuniorUser()) {
                    $point += 1;
                    array_push($roles, 'junior user');
                }
                if ($request->user()->isSeniorUser()) {
                    $point += 1;
                    array_push($roles, 'senior user');
                }
                if ($request->user()->isExpertUser()) {
                    $point += 2;
                    array_push($roles, 'expert user');
                }
                if ($request->user()->isLegendUser()) {
                    $point += 3;
                    array_push($roles, 'legend user');
                }

                if ($request->user()->isJuniorManager()) {
                    $point += 2;
                    array_push($roles, 'junior manager');
                }
                if ($request->user()->isSeniorManager()) {
                    $point += 2;
                    array_push($roles, 'senior manager');
                }
                if ($request->user()->isExpertManager()) {
                    $point += 3;
                    array_push($roles, 'expert manager');
                }
                if ($request->user()->isLegendManager()) {
                    $point += 4;
                    array_push($roles, 'legend manager');
                }

                $review = $this->reviewRepository->create([
                    'card_id' => $id->id,
                    'model_id' => $request->user()->id,
                    'point' => $point,
                    'roles' => $roles,
                ]);
                $card = new Item($review->card, new ReviewTransformer());
                $response = $this->fractal->createData($card);

                return response()->json($response->toArray());
            }
        }
    }

    /**
     * @param ReviewFailedRequest $request
     * @param Cards $id
     * @return \Illuminate\Http\Response
     */
    public function failed(ReviewFailedRequest $request, Cards $id)
    {
        if ($id->isActive()) {
            throw new GeneralException(__('exceptions.frontend.social.cards.review.card_is_active'));
        } else {
            if ($this->reviewRepository->findByCardId($id->id, $request->user()->id)) {
                throw new GeneralException(__('exceptions.frontend.social.cards.review.already_failed'));
            } else {
                $point = -1;
                $roles = ['user'];
                if ($request->user()->isAdmin()) {
                    $point -= 99;
                    array_push($roles, 'administrator');
                    // $this->backendCardsRepository->banned($request->user(), $id, ['remarks' => '違反版規。']);
                }
                if ($request->user()->isJuniorVIP()) {
                    $point -= 1;
                    array_push($roles, 'junior vip');
                }
                if ($request->user()->isSeniorVIP()) {
                    $point -= 2;
                    array_push($roles, 'senior vip');
                }
                if ($request->user()->isExpertVIP()) {
                    $point -= 3;
                    array_push($roles, 'expert vip');
                }
                if ($request->user()->isLegendVIP()) {
                    $point -= 4;
                    array_push($roles, 'legend vip');
                }

                if ($request->user()->isJuniorDonate()) {
                    $point -= 1;
                    array_push($roles, 'junior donate');
                }
                if ($request->user()->isSeniorDonate()) {
                    $point -= 2;
                    array_push($roles, 'senior donate');
                }
                if ($request->user()->isExpertDonate()) {
                    $point -= 3;
                    array_push($roles, 'expert donate');
                }
                if ($request->user()->isLegendDonate()) {
                    $point -= 4;
                    array_push($roles, 'legend donate');
                }

                if ($request->user()->isJuniorUser()) {
                    $point -= 1;
                    array_push($roles, 'junior user');
                }
                if ($request->user()->isSeniorUser()) {
                    $point -= 1;
                    array_push($roles, 'senior user');
                }
                if ($request->user()->isExpertUser()) {
                    $point -= 2;
                    array_push($roles, 'expert user');
                }
                if ($request->user()->isLegendUser()) {
                    $point -= 3;
                    array_push($roles, 'legend user');
                }

                if ($request->user()->isJuniorManager()) {
                    $point -= 2;
                    array_push($roles, 'junior manager');
                }
                if ($request->user()->isSeniorManager()) {
                    $point -= 2;
                    array_push($roles, 'senior manager');
                }
                if ($request->user()->isExpertManager()) {
                    $point -= 3;
                    array_push($roles, 'expert manager');
                }
                if ($request->user()->isLegendManager()) {
                    $point -= 4;
                    array_push($roles, 'legend manager');
                }

                $review = $this->reviewRepository->create([
                    'card_id' => $id->id,
                    'model_id' => $request->user()->id,
                    'point' => $point,
                    'roles' => $roles,
                ]);
                $card = new Item($review->card, new ReviewTransformer());
                $response = $this->fractal->createData($card);

                return response()->json($response->toArray());
            }
        }
    }
}
