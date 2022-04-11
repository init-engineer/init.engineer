<?php

namespace App\Http\Controllers;

use App\Services\OpCacheDataModel;

/**
 * Class MonitorController.
 */
class MonitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.opcache');

        // $model = new OpCacheDataModel();
        // return view('frontend.opcache2')
        //     ->with('getPageTitle', $model->getPageTitle())
        //     ->with('getStatusDataRows', $model->getStatusDataRows())
        //     ->with('getConfigDataRows', $model->getConfigDataRows())
        //     ->with('getScriptStatusCount', $model->getScriptStatusCount())
        //     ->with('getScriptStatusRows', $model->getScriptStatusRows())
        //     ->with('getGraphDataSetJson', $model->getGraphDataSetJson())
        //     ->with('getHumanUsedMemory', $model->getHumanUsedMemory())
        //     ->with('getHumanFreeMemory', $model->getHumanFreeMemory())
        //     ->with('getHumanWastedMemory', $model->getHumanWastedMemory())
        //     ->with('getWastedMemoryPercentage', $model->getWastedMemoryPercentage())
        //     ->with('getD3Scripts', json_encode($model->getD3Scripts()));
    }
}
