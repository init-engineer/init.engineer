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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.social.index');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function review()
    {
        return view('frontend.social.review');
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

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect()
    {
        return redirect()->route('frontend.social.cards.publish.article');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function article()
    {
        return view('frontend.social.publish.article');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function picture()
    {
        return view('frontend.social.publish.picture');
    }
}
