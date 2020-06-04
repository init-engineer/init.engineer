<?php

namespace App\Http\Controllers\Api\Frontend\User;

use League\Fractal\Manager;
use App\Models\Social\Review;
use League\Fractal\Resource\Item;
use App\Http\Controllers\Controller;
use App\Http\Transformers\User\ProfileTransformer;
use App\Repositories\Frontend\Auth\UserRepository;
use App\Http\Requests\Api\Frontend\User\Profile\ManageProfileRequest;

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
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * ProfileController constructor.
     *
     * @param Manager $fractal
     * @param UserRepository $userRepository
     */
    public function __construct(Manager $fractal, UserRepository $userRepository)
    {
        $this->fractal = $fractal;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManageProfileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(ManageProfileRequest $request)
    {
        $profile = new Item($request->user(), new ProfileTransformer());
        $response = $this->fractal->createData($profile);

        return response()->json($response->toArray());
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function roles(ManageProfileRequest $request)
    {
        return response()->json($request->user()->getRoleNames()->toArray());
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function reviewCount(ManageProfileRequest $request)
    {
        return response()->json([
            'count' => count(Review::where('model_id', $request->user()->id)->get()),
        ]);
    }
}
