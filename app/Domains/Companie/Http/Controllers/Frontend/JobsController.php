<?php

namespace App\Domains\Companie\Http\Controllers\Frontend;

use App\Domains\Companie\Models\CompanieJobs;
use App\Domains\Companie\Models\Companies;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    /**
     * @param Request $request
     * @param Companies $companie
     *
     * @return mixed
     */
    public function list(Request $request, Companies $companie)
    {
        if ($request->user()->id !== $companie->model_id) {
            return redirect()
                ->route(homeRoute())
                ->withFlashDanger(__('You do not have access to do that.'));
        }

        // ...
    }

    /**
     * @param Request $request
     * @param Companies $companie
     *
     * @return mixed
     */
    public function create(Request $request, Companies $companie)
    {
        if ($request->user()->id !== $companie->model_id) {
            return redirect()
                ->route(homeRoute())
                ->withFlashDanger(__('You do not have access to do that.'));
        }

        // ...
    }

    /**
     * @param Request $request
     * @param Companies $companie
     * @param CompanieJobs $job
     *
     * @return mixed
     */
    public function edit(Request $request, Companies $companie, CompanieJobs $job)
    {
        if ($request->user()->id !== $companie->model_id ||
            $companie->id !== $job->companie_id) {
            return redirect()
                ->route(homeRoute())
                ->withFlashDanger(__('You do not have access to do that.'));
        }

        // ...
    }

    /**
     * @param Request $request
     * @param CompanieJobs $job
     *
     * @return \Illuminate\View\View
     */
    public function show(CompanieJobs $job)
    {
        return view('frontend.jobs.show')
            ->with('job', $job)
            ->with('companie', $job->companie());
    }

    /**
     * @param Request $request
     * @param Companies $companie
     * @param CompanieJobs $job
     *
     * @return mixed
     */
    public function destroy(Request $request, Companies $companie, CompanieJobs $job)
    {
        if ($request->user()->id !== $companie->model_id ||
            $companie->id !== $job->companie_id) {
            return redirect()
                ->route(homeRoute())
                ->withFlashDanger(__('You do not have access to do that.'));
        }

        // ...
    }
}
