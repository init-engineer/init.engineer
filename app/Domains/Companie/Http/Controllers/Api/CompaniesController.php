<?php

namespace App\Domains\Companie\Http\Controllers\Api;

use App\Domains\Companie\Http\Requests\Api\StoreCompanieRequest;
use App\Domains\Companie\Http\Resources\CompanieResource;
use App\Domains\Companie\Services\CompanieService;
use App\Http\Controllers\Controller;

/**
 * Class CompaniesController.
 */
class CompaniesController extends Controller
{
    /**
     * @var CompanieService
     */
    protected $service;

    /**
     * CompaniesController constructor.
     *
     * @param CompanieService $service
     */
    public function __construct(CompanieService $service)
    {
        $this->service = $service;
    }

    /**
     * @param StoreCompanieRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCompanieRequest $request)
    {
        /**
         * 整理公司資訊
         */
        $data = $request->validated();
        $data['model_id'] = $request->user()->id;

        /**
         * 整理 Logo
         */
        if($request->has('logo')) {
            $path = $request->file('logo')->store('public/companie/logo');
            $path = str_replace('public', 'storage', $path);
            $data['logo'] = [
                'local' => $path,
                'storage' => null,
                'imgur' => null,
            ];
        }

        /**
         * 整理 Banner
         */
        if($request->has('banner')) {
            $path = $request->file('banner')->store('public/companie/banner');
            $path = str_replace('public', 'storage', $path);
            $data['banner'] = [
                'local' => $path,
                'storage' => null,
                'imgur' => null,
            ];
        }

        /**
         * 整理 Pictures
         */
        if($request->has('pictures')) {
            $pictures = [];
            foreach ($request->file('pictures') as $picture) {
                $path = $picture->store('public/companie/pictures');
                $path = str_replace('public', 'storage', $path);
                array_push($pictures, [
                    'local' => $path,
                    'storage' => null,
                    'imgur' => null,
                ]);
            }
            $data['pictures'] = $pictures;
        }

        $companie = $this->service->store($data);

        // event(new CompanieCreated($companie));

        return new CompanieResource($companie);
    }
}
