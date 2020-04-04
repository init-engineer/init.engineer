<?php

namespace App\Http\Controllers\Frontend\Animal;

use App\Http\Controllers\Controller;

/**
 * Class AnimalController.
 */
class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.animal.kohlrabi');
    }
}
