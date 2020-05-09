<?php

namespace App\Http\Controllers\Frontend\User;

use League\Fractal\Manager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Frontend\User\Profile\ManageProfileRequest;
use App\Http\Transformers\User\ProfileTransformer;
use App\Repositories\Frontend\Auth\UserRepository;
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
}
