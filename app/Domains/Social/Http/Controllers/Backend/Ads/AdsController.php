<?php

namespace App\Domains\Social\Http\Controllers\Backend\Ads;

use App\Domains\Social\Http\Requests\Backend\Ads\DeleteAdsRequest;
use App\Domains\Social\Http\Requests\Backend\Ads\EditAdsRequest;
use App\Domains\Social\Http\Requests\Backend\Ads\StoreAdsRequest;
use App\Domains\Social\Http\Requests\Backend\Ads\UpdateAdsRequest;
use App\Domains\Social\Models\Ads;
use App\Domains\Social\Services\AdsService;
use App\Http\Controllers\Controller;

/**
 * Class AdsController.
 */
class AdsController extends Controller
{
    /**
     * @var AdsService
     */
    protected $adsService;

    /**
     * AdsController constructor.
     *
     * @param AdsService $adsService
     */
    public function __construct(AdsService $adsService)
    {
        $this->adsService = $adsService;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.social.ads.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.social.ads.create');
    }

    /**
     * @param StoreAdsRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(StoreAdsRequest $request)
    {
        $data = $request->validated();
        $data['model_id'] = $request->user()->id;
        $data['ads_path'] = $request->file('ads_banner')->storePublicly('public/ads');
        $ads = $this->adsService->store($data);

        return redirect()->route('admin.social.ads.show', $ads)->withFlashSuccess(__('The ads was successfully created.'));
    }

    /**
     * @param Ads $ads
     *
     * @return mixed
     */
    public function show(Ads $ads)
    {
        return view('backend.social.ads.show')
            ->with('ads', $ads);
    }

    /**
     * @param EditAdsRequest $request
     * @param Ads $ads
     *
     * @return mixed
     */
    public function edit(EditAdsRequest $request, Ads $ads)
    {
        return view('backend.social.ads.edit')
            ->with('ads', $ads);
    }

    /**
     * @param UpdateAdsRequest $request
     * @param Ads $ads
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateAdsRequest $request, Ads $ads)
    {
        $this->adsService->update($ads, $request->validated());

        return redirect()->route('admin.social.ads.show', $ads)->withFlashSuccess(__('The ads was successfully updated.'));
    }

    /**
     * @param DeleteAdsRequest $request
     * @param Ads $ads
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy(DeleteAdsRequest $request, Ads $ads)
    {
        $this->adsService->delete($ads);

        return redirect()->route('admin.social.ads.deleted')->withFlashSuccess(__('The ads was successfully deleted.'));
    }
}
