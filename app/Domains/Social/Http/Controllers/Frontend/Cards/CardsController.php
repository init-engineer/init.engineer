<?php

namespace App\Domains\Social\Http\Controllers\Frontend\Cards;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.social.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.social.create');
    }
}
