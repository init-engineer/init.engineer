<?php

namespace App\Http\Controllers\Frontend;

use App\Domains\Social\Services\CardsService;
use App\Http\Controllers\Controller;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @var CardsService
     */
    public $cardsService;

    /**
     * @param CardsService $cardsService
     */
    public function __construct(CardsService $cardsService)
    {
        $this->cardsService = $cardsService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $newCards = $this->cardsService->getPaginated(5, 'id');
        $safeCards = $this->cardsService->getActivePaginated(5, 'id');

        return view('frontend.index')
            ->with('newCards', $newCards)
            ->with('safeCards', $safeCards);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function opcache()
    {
        return view('frontend.opcache');
    }
}
