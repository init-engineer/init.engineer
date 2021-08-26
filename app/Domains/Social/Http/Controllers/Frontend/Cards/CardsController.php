<?php

namespace App\Domains\Social\Http\Controllers\Frontend\Cards;

use App\Domains\Social\Models\Cards;
use App\Http\Controllers\Controller;

/**
 * Class CardsController.
 */
class CardsController extends Controller
{
    /**
     * CardsController constructor.
     */
    public function __construct() {
        // ...
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.social.index');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('frontend.social.create');
    }

    /**
     * @param Cards $id
     *
     * @return \Illuminate\View\View
     */
    public function show(Cards $id)
    {
        return view('frontend.social.show')
            ->with('cards', $id);
    }
}
