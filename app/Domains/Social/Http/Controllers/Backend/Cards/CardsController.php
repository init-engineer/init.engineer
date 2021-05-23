<?php

namespace App\Domains\Social\Http\Controllers\Backend\Cards;

use App\Domains\Social\Http\Requests\Backend\Cards\DeleteCardsRequest;
use App\Domains\Social\Http\Requests\Backend\Cards\EditCardsRequest;
use App\Domains\Social\Http\Requests\Backend\Cards\StoreCardsRequest;
use App\Domains\Social\Http\Requests\Backend\Cards\UpdateCardsRequest;
use App\Domains\Social\Models\Cards;
use App\Domains\Social\Services\CardsService;
use App\Http\Controllers\Controller;

/**
 * Class CardsController.
 */
class CardsController extends Controller
{
    /**
     * @var CardsService
     */
    protected $cardsService;

    /**
     * CardsController constructor.
     *
     * @param CardsService $cardsService
     */
    public function __construct(CardsService $cardsService)
    {
        $this->cardsService = $cardsService;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.social.cards.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.social.cards.create');
    }

    /**
     * @param StoreCardsRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(StoreCardsRequest $request)
    {
        $cards = $this->cardsService->store($request->validated());

        return redirect()->route('admin.social.cards.show', $cards)->withFlashSuccess(__('The cards was successfully created.'));
    }

    /**
     * @param Cards $cards
     *
     * @return mixed
     */
    public function show(Cards $cards)
    {
        return view('backend.social.cards.show')
            ->with('cards', $cards);
    }

    /**
     * @param EditCardsRequest $request
     * @param Cards $cards
     *
     * @return mixed
     */
    public function edit(EditCardsRequest $request, Cards $cards)
    {
        return view('backend.social.cards.edit')
            ->with('cards', $cards);
    }

    /**
     * @param UpdateCardsRequest $request
     * @param Cards $cards
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateCardsRequest $request, Cards $cards)
    {
        $this->cardsService->update($cards, $request->validated());

        return redirect()->route('admin.social.cards.show', $cards)->withFlashSuccess(__('The cards was successfully updated.'));
    }

    /**
     * @param DeleteCardsRequest $request
     * @param Cards $cards
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy(DeleteCardsRequest $request, Cards $cards)
    {
        $this->cardsService->delete($cards);

        return redirect()->route('admin.social.cards.deleted')->withFlashSuccess(__('The cards was successfully deleted.'));
    }
}
