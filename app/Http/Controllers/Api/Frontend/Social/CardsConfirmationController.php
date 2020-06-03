<?php

namespace App\Http\Controllers\Api\Frontend\Social;

use League\Fractal\Manager;
use App\Models\Social\Cards;
use League\Fractal\Resource\Item;
use App\Http\Controllers\Controller;
use App\Exceptions\GeneralException;
use App\Services\Socials\Cards\CardsService;
use App\Http\Transformers\Social\ReviewTransformer;
use App\Repositories\Backend\Social\CardsRepository as BackendCardsRepository;
use App\Repositories\Frontend\Social\CardsRepository as FrontendCardsRepository;
use App\Repositories\Frontend\Social\ReviewRepository;
use App\Http\Requests\Api\Frontend\Social\Cards\ReviewFailedRequest;
use App\Http\Requests\Api\Frontend\Social\Cards\ReviewSucceededRequest;

/**
 * Class CardsConfirmationController.
 */
class CardsConfirmationController extends Controller
{
    /**
     * @var Manager
     */
    protected $fractal;

    /**
     * @var CardsService
     */
    protected $cardsService;

    /**
     * @var ReviewRepository
     */
    protected $reviewRepository;

    /**
     * @var BackendCardsRepository
     */
    protected $backendCardsRepository;

    /**
     * @var FrontendCardsRepository
     */
    protected $frontendCardsRepository;

    /**
     * CardsConfirmationController constructor.
     *
     * @param Manager $fractal
     * @param CardsService $cardsService
     * @param ReviewRepository $reviewRepository
     * @param BackendCardsRepository $backendCardsRepository
     * @param FrontendCardsRepository $frontendCardsRepository
     */
    public function __construct(
        Manager $fractal,
        CardsService $cardsService,
        ReviewRepository $reviewRepository,
        BackendCardsRepository $backendCardsRepository,
        FrontendCardsRepository $frontendCardsRepository)
    {
        $this->fractal = $fractal;
        $this->cardsService = $cardsService;
        $this->reviewRepository = $reviewRepository;
        $this->backendCardsRepository = $backendCardsRepository;
        $this->frontendCardsRepository = $frontendCardsRepository;
    }

    /**
     * @param ReviewSucceededRequest $request
     * @param Cards $id
     * @return \Illuminate\Http\Response
     */
    public function succeeded(ReviewSucceededRequest $request, Cards $id)
    {
        if ($id->isActive())
        {
            throw new GeneralException(__('exceptions.frontend.social.cards.review.card_is_active'));
        }
        else
        {
            if ($this->reviewRepository->findByCardId($id->id, $request->user()->id))
            {
                throw new GeneralException(__('exceptions.frontend.social.cards.review.already_succeeded'));
            }
            else
            {
                $point = 1;
                $roles = ['user'];
                if ($request->user()->isAdmin())
                {
                    $point += 99;
                    array_push($roles, 'administrator');
                    $this->backendCardsRepository->active($id);
                    $this->cardsService->publish($id);
                }
                if ($request->user()->isJuniorVIP())     { $point += 1;  array_push($roles, 'junior vip'); }
                if ($request->user()->isSeniorVIP())     { $point += 2;  array_push($roles, 'senior vip'); }
                if ($request->user()->isJuniorDonate())  { $point += 2;  array_push($roles, 'junior donate'); }
                if ($request->user()->isSeniorDonate())  { $point += 4;  array_push($roles, 'senior donate'); }
                if ($request->user()->isJuniorUser())    { $point += 1;  array_push($roles, 'junior user'); }
                if ($request->user()->isSeniorUser())    { $point += 2;  array_push($roles, 'senior user'); }
                if ($request->user()->isJuniorManager()) { $point += 4;  array_push($roles, 'junior manager'); }
                if ($request->user()->isSeniorManager()) { $point += 9;  array_push($roles, 'senior manager'); }

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
        if ($id->isActive())
        {
            throw new GeneralException(__('exceptions.frontend.social.cards.review.card_is_active'));
        }
        else
        {
            if ($this->reviewRepository->findByCardId($id->id, $request->user()->id))
            {
                throw new GeneralException(__('exceptions.frontend.social.cards.review.already_failed'));
            }
            else
            {
                $point = -1;
                $roles = ['user'];
                if ($request->user()->isAdmin())
                {
                    $point -= 99;
                    array_push($roles, 'administrator');
                    $this->backendCardsRepository->banned($request->user(), $id, ['remarks' => '違反版規。']);
                }
                if ($request->user()->isJuniorVIP())     { $point -= 1;  array_push($roles, 'junior vip'); }
                if ($request->user()->isSeniorVIP())     { $point -= 2;  array_push($roles, 'senior vip'); }
                if ($request->user()->isJuniorDonate())  { $point -= 2;  array_push($roles, 'junior donate'); }
                if ($request->user()->isSeniorDonate())  { $point -= 4;  array_push($roles, 'senior donate'); }
                if ($request->user()->isJuniorUser())    { $point -= 1;  array_push($roles, 'junior user'); }
                if ($request->user()->isSeniorUser())    { $point -= 2;  array_push($roles, 'senior user'); }
                if ($request->user()->isJuniorManager()) { $point -= 4;  array_push($roles, 'junior manager'); }
                if ($request->user()->isSeniorManager()) { $point -= 9;  array_push($roles, 'senior manager'); }

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
