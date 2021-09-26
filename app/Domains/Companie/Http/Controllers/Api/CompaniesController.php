<?php

namespace App\Domains\Companie\Http\Controllers\Api;

use App\Domains\Companie\Http\Requests\Api\StoreCompanieRequest;
use App\Http\Controllers\Controller;

/**
 * Class CompaniesController.
 */
class CompaniesController extends Controller
{
    /**
     * CompaniesController constructor.
     */
    public function __construct()
    {
        // Code ...
    }

    /**
     * @param StoreCompanieRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCompanieRequest $request)
    {
        // ...
    }
}
