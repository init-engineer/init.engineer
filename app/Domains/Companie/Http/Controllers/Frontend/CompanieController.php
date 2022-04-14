<?php

namespace App\Domains\Companie\Http\Controllers\Frontend;

use App\Domains\Companie\Models\Companies;
use App\Domains\Companie\Services\CompanieService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class CompanieController.
 */
class CompanieController extends Controller
{
    /**
     * @var CompanieService
     */
    protected $service;

    /**
     * CompanieController constructor.
     *
     * @param CompanieService $service
     */
    public function __construct(CompanieService $service)
    {
        $this->service = $service;
    }

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

    /**
     * @param Companies $companie
     *
     * @return \Illuminate\View\View
     */
    public function show(Companies $companie)
    {
        return view('frontend.companie.show')
            ->with('companie', $companie);
    }

    /**
     * @param Request $request
     * @param Companies $companie
     *
     * @return mixed
     */
    public function edit(Request $request, Companies $companie)
    {
        if ($request->user()->id !== $companie->model_id) {
            return redirect()
                ->route(homeRoute())
                ->withFlashDanger(__('You do not have access to do that.'));
        }

        return view('frontend.companie.edit')
            ->with('companie', $companie);
    }

    /**
     * @param Request $request
     * @param Companies $companie
     *
     * @return mixed
     */
    public function destroy(Request $request, Companies $companie)
    {
        if ($request->user()->id !== $companie->model_id) {
            return redirect()
                ->route(homeRoute())
                ->withFlashDanger(__('You do not have access to do that.'));
        }

        $this->service->delete($companie);

        return redirect()
            ->route('frontend.companie.index')
            ->withFlashSuccess(__('The companie was successfully deleted.'));
    }
}
