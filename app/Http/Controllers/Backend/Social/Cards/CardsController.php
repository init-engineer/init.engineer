<?php

namespace App\Http\Controllers\Backend\Social\Cards;

use App\Models\Social\Cards;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Social\CardsRepository;
use App\Http\Requests\Backend\Social\Cards\ManageCardsRequest;

/**
 * Class CardsController.
 */
class CardsController extends Controller
{
    /**
     * @var CardsRepository
     */
    protected $cardsRepository;

    /**
     * @param CardsRepository $cardsRepository
     */
    public function __construct(CardsRepository $cardsRepository)
    {
        $this->cardsRepository = $cardsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManageCardsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(ManageCardsRequest $request)
    {
        return view('backend.social.cards.index')
            ->withCards($this->cardsRepository->getActivePaginated());
    }

    /**
     * Display the specified resource.
     *
     * @param Cards $cards
     * @return \Illuminate\Http\Response
     */
    public function show(Cards $cards)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Cards $cards
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cards $cards)
    {
        $this->cardsRepository->deleteById($cards->id);

        // event(new CardsDeleted($cards));

        return redirect()->route('admin.social.cards.deleted')->withFlashSuccess(__('alerts.backend.social.cards.deleted'));
    }
}
