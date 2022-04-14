<?php

namespace App\Domains\Social\Http\Controllers\Backend\Ads;

use App\Domains\Social\Models\Ads;
use App\Domains\Social\Services\AdsService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class DeactivatedAdsController.
 */
class DeactivatedAdsController extends Controller
{
    /**
     * @var AdsService
     */
    protected $adsService;

    /**
     * DeactivatedAdsController constructor.
     *
     * @param AdsService $adsService
     */
    public function __construct(AdsService $adsService)
    {
        $this->adsService = $adsService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.social.ads.deactivated');
    }

    /**
     * @param Request $request
     * @param Ads $ads
     * @param $status
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(Request $request, Ads $ads, $status)
    {
        $this->adsService->mark($ads, (int) $status);

        return redirect()->route(
            (int) $status === 1 || ! $request->user()->can('admin.social.ads.reactivate') ?
                'admin.social.ads.index' :
                'admin.social.ads.deactivated'
        )->withFlashSuccess(__('The ads was successfully updated.'));
    }
}
