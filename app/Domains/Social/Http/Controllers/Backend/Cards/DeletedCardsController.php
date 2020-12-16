<?php

namespace App\Domains\Social\Http\Controllers\Backend\Cards;

use App\Domains\Social\Models\Cards;
use App\Domains\Social\Services\CardsService;
use App\Http\Controllers\Controller;

/**
 * Class DeletedCardsController.
 */
class DeletedCardsController extends Controller
{
    /**
     * @var CardsService
     */
    protected $cardsService;

    /**
     * DeletedCardsController constructor.
     *
     * @param CardsService $cardsService
     */
    public function __construct(CardsService $cardsService)
    {
        $this->cardsService = $cardsService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.social.cards.deleted');
    }

    /**
     * @param Cards $deletedCards
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(Cards $deletedCards)
    {
        $this->cardsService->restore($deletedCards);

        return redirect()->route('admin.social.cards.index')->withFlashSuccess(__('The cards was successfully restored.'));
    }

    /**
     * @param Cards $deletedCards
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy(Cards $deletedCards)
    {
        $this->cardsService->destroy($deletedCards);

        return redirect()->route('admin.social.cards.deleted')->withFlashSuccess(__('The cards was permanently deleted.'));
    }
}
