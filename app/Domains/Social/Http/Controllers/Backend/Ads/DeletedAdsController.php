<?php

namespace App\Domains\Social\Http\Controllers\Backend\Ads;

use App\Domains\Social\Models\Ads;
use App\Domains\Social\Services\AdsService;
use App\Http\Controllers\Controller;

/**
 * Class DeletedAdsController.
 */
class DeletedAdsController extends Controller
{
    /**
     * @var AdsService
     */
    protected $adsService;

    /**
     * DeletedAdsController constructor.
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
        return view('backend.social.ads.deleted');
    }

    /**
     * @param Ads $deletedAds
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(Ads $deletedAds)
    {
        $this->adsService->restore($deletedAds);

        return redirect()->route('admin.social.ads.index')->withFlashSuccess(__('The ads was successfully restored.'));
    }

    /**
     * @param Ads $deletedAds
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy(Ads $deletedAds)
    {
        $this->adsService->destroy($deletedAds);

        return redirect()->route('admin.social.ads.deleted')->withFlashSuccess(__('The ads was permanently deleted.'));
    }
}
