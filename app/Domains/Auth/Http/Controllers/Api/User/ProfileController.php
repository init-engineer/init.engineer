<?php

namespace App\Domains\Auth\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Frontend\User\Profile\ManageProfileRequest;
use App\Http\Transformers\User\ProfileTransformer;
use App\Models\Social\Review;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;

/**
 * Class ProfileController.
 */
class ProfileController extends Controller
{
    /**
     * @var Manager
     */
    protected $fractal;

    /**
     * ProfileController constructor.
     *
     * @param Manager $fractal
     */
    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManageProfileRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManageProfileRequest $request)
    {
        $item = new Item($request->user(), new ProfileTransformer());
        $response = $this->fractal->createData($item);

        return response()->json($response->toArray());
    }

    /**
     * @param ManageProfileRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function roles(ManageProfileRequest $request)
    {
        return response()->json($request->user()->getRoleNames()->toArray());
    }

    /**
     * @param ManageProfileRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function reviewCount(ManageProfileRequest $request)
    {
        return response()->json(array(
            'count' => count(Review::where('model_id', $request->user()->id)->get()),
        ));
    }
}
