<?php

namespace App\Domains\Companie\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

/**
 * Class JobsController.
 */
class JobsController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.jobs.index');
    }
}
