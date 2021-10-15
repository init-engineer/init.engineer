<?php

namespace App\Domains\Companie\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

/**
 * Class CompanieController.
 */
class CompanieController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.companie.index');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('frontend.companie.create');
    }
}
