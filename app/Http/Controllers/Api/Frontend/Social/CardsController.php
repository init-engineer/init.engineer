<?php

namespace App\Http\Controllers\Api\Frontend\Social;

use League\Fractal\Manager;
use App\Models\Social\Cards;
use League\Fractal\Resource\Item;
use App\Http\Controllers\Controller;
use League\Fractal\Resource\Collection;
use App\Services\Socials\Cards\CardsService;
use App\Services\Socials\Images\ImagesService;
use App\Http\Transformers\Social\CardsTransformer;
use App\Http\Transformers\Social\ReviewTransformer;
use App\Http\Transformers\Social\CommentsTransformer;
use App\Http\Transformers\IlluminatePaginatorAdapter;
use App\Repositories\Frontend\Social\CardsRepository;
use App\Repositories\Frontend\Social\ImagesRepository;
use App\Repositories\Frontend\Social\ReviewRepository;
use App\Http\Transformers\Social\MediaCardsTransformer;
use App\Repositories\Frontend\Social\CommentsRepository;
use App\Http\Transformers\Social\DashboardCardsTransformer;
use App\Http\Requests\Api\Frontend\Social\Cards\ReviewRequest;
use App\Http\Requests\Api\Frontend\Social\Cards\DashboardRequest;
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
     * @var CardsService
     */
    protected $cardsService;

    /**
     * @var ImagesService
     */
    protected $imagesService;

    /**
     * @var CardsRepository
     */
    protected $cardsRepository;

    /**
     * @var ImagesRepository
     */
    protected $imagesRepository;

    /**
     * @var ReviewRepository
     */
    protected $reviewRepository;

    /**
     * @var CommentsRepository
     */
    protected $commentsRepository;

    /**
     * CardsController constructor.
     *
     * @param Manager $fractal
     * @param CardsService $cardsService
     * @param ImagesService $imagesService
     * @param CardsRepository $cardsRepository
     * @param ImagesRepository $imagesRepository
     * @param ReviewRepository $reviewRepository
     * @param CommentsRepository $commentsRepository
     */
    public function __construct(
        Manager $fractal,
        CardsService $cardsService,
        ImagesService $imagesService,
        CardsRepository $cardsRepository,
        ImagesRepository $imagesRepository,
        ReviewRepository $reviewRepository,
        CommentsRepository $commentsRepository)
    {
        $this->fractal = $fractal;
        $this->cardsService = $cardsService;
        $this->imagesService = $imagesService;
        $this->cardsRepository = $cardsRepository;
        $this->imagesRepository = $imagesRepository;
        $this->reviewRepository = $reviewRepository;
        $this->commentsRepository = $commentsRepository;
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
     * @param ReviewRequest $request
     * @return \Illuminate\Http\Response
     */
    public function review(ReviewRequest $request)
    {
        $paginator = $this->cardsRepository->getUnactivePaginated();
        $cards = new Collection($paginator->items(), new ReviewTransformer());
        $cards->setPaginator(new IlluminatePaginatorAdapter($paginator));
        $response = $this->fractal->createData($cards);
        $response = $response->toArray();
        foreach ($response['data'] as $key => $value)
        {
            $review = $this->reviewRepository->findByCardId($value['id'], $request->user()->id);
            $response['data'][$key]['review'] = $review? $review->point : 0;
        }

        return response()->json($response);
    }

    /**
     * @param DashboardRequest $request
     * @return \Illuminate\Http\Response
     */
    public function dashboard(DashboardRequest $request)
    {
        $paginator = $this->cardsRepository->getDashboardPaginated($request->user());
        $cards = new Collection($paginator->items(), new DashboardCardsTransformer());
        $cards->setPaginator(new IlluminatePaginatorAdapter($paginator));
        $response = $this->fractal->createData($cards);

        return response()->json($response->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCardsRequest $request
     * @param ImagesService $imagesService
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCardsRequest $request)
    {
        $modelCard = $this->cardsRepository->create([
            'model_id' => $request->user()->id,
            'content' => $request->input('content'),
        ]);

        $avatar = $request->has('avatar')?
            $this->imagesService->uploadImage([], $request->file('avatar')) :
            $this->imagesService->buildImage($request->only('content', 'themeStyle', 'fontStyle', 'isFeatureToBeCoutinued'), $modelCard);

        $this->imagesRepository->create([
            'card_id' => $modelCard->id,
            'model_id' => $request->user()->id,
            'avatar' => [
                'path' => $avatar['avatar']['path'],
                'name' => $avatar['avatar']['name'],
                'type' => $avatar['avatar']['type'],
            ],
        ]);

        // $this->cardsService->publish($modelCard);

        $cards = new Item($modelCard, new CardsTransformer());
        $response = $this->fractal->createData($cards);

        return response()->json($response->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param Cards $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cards $id)
    {
        $cards = new Item($id->isPublish()? $id : null, new CardsTransformer());
        $response = $this->fractal->createData($cards);

        return response()->json($response->toArray());
    }

    /**
     * @param Cards $id
     * @return \Illuminate\Http\Response
     */
    public function links(Cards $id)
    {
        $medias = $id->medias->reject(function ($media) {
            return $media->isPublish();
        });
        $cards = new Collection($medias, new MediaCardsTransformer());
        $response = $this->fractal->createData($cards);

        return response()->json($response->toArray());
    }

    /**
     * @param Cards $id
     * @return \Illuminate\Http\Response
     */
    public function comments(Cards $id)
    {
        $paginator = $this->commentsRepository->getActivePaginated($id);
        $comments = new Collection($paginator->items(), new CommentsTransformer());
        $comments->setPaginator(new IlluminatePaginatorAdapter($paginator));
        $response = $this->fractal->createData($comments);

        return response()->json($response->toArray());
    }
}
