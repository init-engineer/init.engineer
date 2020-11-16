<?php

namespace App\Http\Controllers\Api\Frontend\Social\Cards;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Frontend\Social\Cards\DashboardRequest;
use App\Http\Requests\Api\Frontend\Social\Cards\StoreCardsRequest;
use App\Http\Transformers\IlluminatePaginatorAdapter;
use App\Http\Transformers\Social\CardPostTransformer;
use App\Http\Transformers\Social\CardsTransformer;
use App\Http\Transformers\Social\CommentsTransformer;
use App\Http\Transformers\Social\DashboardCardsTransformer;
use App\Models\Social\Cards;
use App\Repositories\Frontend\Social\CardsRepository;
use App\Repositories\Frontend\Social\CommentsRepository;
use App\Repositories\Frontend\Social\ImagesRepository;
use App\Services\SocialImage\ImagesService;
use Illuminate\Container\Container;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

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
        $collection = new Collection($paginator->items(), new CardsTransformer());
        $collection->setPaginator(new IlluminatePaginatorAdapter($paginator));
        $response = $this->fractal->createData($collection);

        return response()->json($response->toArray());
    }

    /**
     * @param DashboardRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(DashboardRequest $request)
    {
        $paginator = $this->cardsRepository->getDashboardPaginated($request->user());
        $collection = new Collection($paginator->items(), new DashboardCardsTransformer());
        $collection->setPaginator(new IlluminatePaginatorAdapter($paginator));
        $response = $this->fractal->createData($collection);

        return response()->json($response->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCardsRequest $request
     * @param ImagesService $imagesService
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCardsRequest $request)
    {
        $modelCard = $this->cardsRepository->create(array(
            'model_id' => $request->user()->id,
            'content' => $request->input('content'),
            'config' => array(
                'setting' => $request->only('themeStyle', 'fontStyle', 'isFeatureToBeCoutinued'),
            ),
        ));

        $imagesService = Container::getInstance()->make(ImagesService::class);
        $avatar = $request->has('avatar') ?
            $imagesService->uploadImage(array(), $request->file('avatar')) :
            $imagesService->buildImage($request->only('content', 'themeStyle', 'fontStyle', 'isFeatureToBeCoutinued'), $modelCard);

        $imagesRepository = Container::getInstance()->make(ImagesRepository::class);
        $imagesRepository->create(array(
            'card_id' => $modelCard->id,
            'model_id' => $request->user()->id,
            'avatar' => $avatar,
        ));

        $item = new Item($modelCard, new CardsTransformer());
        $response = $this->fractal->createData($item);

        return response()->json($response->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param Cards $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Cards $id)
    {
        $item = new Item($id->isPublish() ? $id : null, new CardsTransformer());
        $response = $this->fractal->createData($item);

        return response()->json($response->toArray());
    }

    /**
     * @param Cards $id
     *
     * @return \Illuminate\Http\Response
     */
    public function links(Cards $id)
    {
        $posts = $id->posts->reject(function ($post) {
            return $post->isPublish();
        });
        $collection = new Collection($posts, new CardPostTransformer());
        $response = $this->fractal->createData($collection);

        return response()->json($response->toArray());
    }

    /**
     * @param Cards $id
     *
     * @return \Illuminate\Http\Response
     */
    public function comments(Cards $id)
    {
        $commentsRepository = Container::getInstance()->make(CommentsRepository::class);
        $paginator = $commentsRepository->getActivePaginated($id);
        $collection = new Collection($paginator->items(), new CommentsTransformer());
        $collection->setPaginator(new IlluminatePaginatorAdapter($paginator));
        $response = $this->fractal->createData($collection);

        return response()->json($response->toArray());
    }
}
