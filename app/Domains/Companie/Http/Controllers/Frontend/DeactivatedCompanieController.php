<?php

namespace App\Domains\Companie\Http\Controllers\Frontend;

use App\Domains\Companie\Models\Companies;
use App\Domains\Companie\Services\CompanieService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class DeactivatedCompanieController.
 */
class DeactivatedCompanieController extends Controller
{
    /**
     * @var CompanieService
     */
    protected $service;

    /**
     * DeactivatedCompanieController constructor.
     *
     * @param CompanieService $service
     */
    public function __construct(CompanieService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @param Companies $companie
     * @param $status
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(Request $request, Companies $companie, $status)
    {
        if ($request->user()->id !== $companie->model_id) {
            return redirect()
                ->route(homeRoute())
                ->withFlashDanger(__('You do not have access to do that.'));
        }

        $this->service->mark($companie, (int) $status);

        return redirect()
            ->route('frontend.companie.index')
            ->withFlashSuccess(__('The companie was successfully updated.'));
    }
}
