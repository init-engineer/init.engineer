<?php

namespace App\Domains\Companie\Http\Controllers\Api;

use App\Domains\Companie\Http\Requests\Api\StoreJobRequest;
use App\Http\Controllers\Controller;

/**
 * Class JobsController.
 */
class JobsController extends Controller
{
    /**
     * JobsController constructor.
     */
    public function __construct()
    {
        // Code ...
    }

    /**
     * @param StoreJobRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreJobRequest $request)
    {
        // Code ...
    }
}
