<?php

namespace App\Http\Controllers\Backend\Social\Cards;

use App\Models\Social\Cards;
use App\Http\Controllers\Controller;
use App\Services\Socials\Cards\CardsService;
use App\Repositories\Backend\Social\CardsRepository;
use App\Http\Requests\Backend\Social\Cards\BannedCardsRequest;
use App\Http\Requests\Backend\Social\Cards\ManageCardsRequest;

/**
 * Class CardsStatusController.
 */
class CardsStatusController extends Controller
{
    /**
     * @var CardsService
     */
    protected $cardsService;

    /**
     * @var CardsRepository
     */
    protected $cardsRepository;

    /**
     * @param CardsService $cardsService
     * @param CardsRepository $cardsRepository
     */
    public function __construct(CardsService $cardsService, CardsRepository $cardsRepository)
    {
        $this->cardsService = $cardsService;
        $this->cardsRepository = $cardsRepository;
    }

    /**
     * @param ManageCardsRequest $request
     *
     * @return mixed
     */
    public function getDeactivated(ManageCardsRequest $request)
    {
        return view('backend.social.cards.deactivated')
            ->withCards($this->cardsRepository->getInactivePaginated());
    }

    /**
     * @param ManageCardsRequest $request
     *
     * @return mixed
     */
    public function getDeleted(ManageCardsRequest $request)
    {
        return view('backend.social.cards.deleted')
            ->withCards($this->cardsRepository->getDeletedPaginated());
    }

    /**
     * @param ManageCardsRequest $request
     * @param Cards              $cards
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function banned(BannedCardsRequest $request, Cards $cards)
    {
        // $this->cardsService->destory($request->user(), $cards, $request->only('remarks'));
        // $this->cardsRepository->banned($request->user(), $cards, $request->only('remarks'));
        $this->cardsService->destory($request->user(), $cards, ['remarks' => '違反版規。']);
        $this->cardsRepository->banned($request->user(), $cards, ['remarks' => '違反版規。']);

        return redirect()->route('admin.social.cards.deactivated')->withFlashSuccess(__('alerts.backend.social.cards.banned'));
    }

    /**
     * @param ManageCardsRequest $request
     * @param Cards              $cards
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function delete(ManageCardsRequest $request, Cards $cards)
    {
        $this->cardsRepository->forceDelete($cards);

        return redirect()->route('admin.social.cards.deleted')->withFlashSuccess(__('alerts.backend.social.cards.deleted_permanently'));
    }

    /**
     * @param ManageCardsRequest $request
     * @param Cards              $cards
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function restore(ManageCardsRequest $request, Cards $cards)
    {
        $this->cardsRepository->restore($cards);

        return redirect()->route('admin.social.cards.index')->withFlashSuccess(__('alerts.backend.social.cards.restored'));
    }
}
