<?php

namespace App\Http\Controllers\Api\Frontend\Social;

use League\Fractal\Manager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Resource\Collection;
use App\Services\Socials\Images\ImagesService;
use App\Http\Transformers\Social\CardsTransformer;
use App\Repositories\Frontend\Social\CardsRepository;
use App\Http\Transformers\IlluminatePaginatorAdapter;
use App\Http\Requests\Api\Frontend\Social\Cards\StoreCardsRequest;

/**
 * Class CardsController.
 */
class CardsController extends Controller
{
    /**
     * @var Manager
     */
    protected $fractal;

    /**
     * @var CardsRepository
     */
    protected $cardsRepository;

    /**
     * CardsController constructor.
     *
     * @param Manager $fractal
     * @param CardsRepository $cardsRepository
     */
    public function __construct(Manager $fractal, CardsRepository $cardsRepository)
    {
        $this->fractal = $fractal;
        $this->cardsRepository = $cardsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->cardsRepository->getActivePaginated();
        $cards = new Collection($paginator->items(), new CardsTransformer());
        $cards->setPaginator(new IlluminatePaginatorAdapter($paginator));
        $response = $this->fractal->createData($cards);

        return response()->json($response->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCardsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCardsRequest $request, ImagesService $imagesService)
    {
        $card = $this->cardsRepository->create([
            'user_id' => $request->user()->id,
            'content' => $request->input('content'),
        ]);

        if ($request->has('avatar'))
        {
            $avatar = $imagesService->uploadImage([

            ], $request->file('avatar'));
        }
        else
        {
            $avatar = $imagesService->buildImage([

            ]);
        }

        // $imagesService->buildImage();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
