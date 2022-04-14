<?php

namespace App\Domains\Social\Http\Controllers\Backend\Cards;

use App\Domains\Social\Models\Cards;
use App\Domains\Social\Services\CardsService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class DeactivatedCardsController.
 */
class DeactivatedCardsController extends Controller
{
    /**
     * @var CardsService
     */
    protected $cardsService;

    /**
     * DeactivatedCardsController constructor.
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
        return view('backend.social.cards.deactivated');
    }

    /**
     * @param Request $request
     * @param Cards $cards
     * @param $status
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(Request $request, Cards $cards, $status)
    {
        $this->cardsService->mark($cards, (int) $status);

        return redirect()->route(
            (int) $status === 1 || ! $request->user()->can('admin.social.cards.reactivate') ?
                'admin.social.cards.index' :
                'admin.social.cards.deactivated'
        )->withFlashSuccess(__('The cards was successfully updated.'));
    }
}
