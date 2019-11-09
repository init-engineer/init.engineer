<?php

namespace App\Http\Controllers\Api\Frontend\Social;

use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Socials\Images\ImagesService;
use App\Http\Transformers\Social\CardsTransformer;
use App\Http\Transformers\IlluminatePaginatorAdapter;
use App\Repositories\Frontend\Social\CardsRepository;
use App\Repositories\Frontend\Social\ImagesRepository;
use App\Http\Requests\Api\Frontend\Social\Cards\StoreCardsRequest;

use App\Jobs\Social\MediaCards\PlurkPrimaryPublish;
use App\Jobs\Social\MediaCards\TwitterPrimaryPublish;
use App\Jobs\Social\MediaCards\FacebookPrimaryPublish;
use App\Jobs\Social\MediaCards\FacebookSecondaryPublish;

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
     * @param ImagesService $imagesService
     * @param ImagesRepository $imagesRepository
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCardsRequest $request, ImagesService $imagesService, ImagesRepository $imagesRepository)
    {
        $modelCard = $this->cardsRepository->create([
            'model_id' => $request->user()->id,
            'content' => $request->input('content'),
        ]);

        $avatar = $request->has('avatar')?
            $imagesService->uploadImage([], $request->file('avatar')) :
            $imagesService->buildImage($request->only('content', 'themeStyle', 'fontStyle'));

        $imagesRepository->create([
            'card_id' => $modelCard->id,
            'model_id' => $request->user()->id,
            'avatar' => [
                'path' => $avatar['avatar']['path'],
                'name' => $avatar['avatar']['name'],
                'type' => $avatar['avatar']['type'],
            ],
        ]);

        if (env('FACEBOOK_PRIMARY_CREATE_POST', false)) { FacebookPrimaryPublish::dispatch($modelCard); }
        if (env('FACEBOOK_SECONDARY_CREATE_POST', false)) { FacebookSecondaryPublish::dispatch($modelCard); }
        if (env('TWITTER_CREATE_POST', false)) { TwitterPrimaryPublish::dispatch($modelCard); }
        if (env('PLURK_CREATE_POST', false)) { PlurkPrimaryPublish::dispatch($modelCard); }

        $cards = new Item($modelCard, new CardsTransformer());
        $response = $this->fractal->createData($cards);

        return response()->json($response->toArray());
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
}
