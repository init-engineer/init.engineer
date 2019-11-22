<?php

namespace App\Http\Controllers\Frontend\Social;

use Illuminate\Http\Request;
use App\Models\Social\Cards;
use App\Http\Controllers\Controller;

/**
 * Class CardsController.
 */
class CardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.social.cards.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.social.cards.create');
    }

    /**
     * Display the specified resource.
     *
     * @param Cards $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cards $id)
    {
        if ($id->isPublish())
        {
            return view('frontend.social.cards.show')
                ->withCard($id)
                ->withImage($id->images->first()->getPicture());
        }

        return redirect()->route('frontend.social.cards.index')->withFlashDanger(__('alerts.frontend.social.cards.not_found'));
    }
}
