<?php

namespace App\Domains\Social\Http\Controllers\Api\Cards;

use App\Domains\Social\Http\Requests\Api\Comments\StoreCommentsRequest;
use App\Domains\Social\Http\Resources\CommentCollection;
use App\Domains\Social\Http\Resources\CommentResource;
use App\Domains\Social\Models\Cards;
use App\Domains\Social\Services\CommentsService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

/**
 * Class CommentsController.
 */
class CommentsController extends Controller
{
    /**
     * @var CommentsService
     */
    protected $service;

    /**
     * CommentsController constructor.
     *
     * @param CommentsService $service
     */
    public function __construct(CommentsService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Cards $card
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Cards $card)
    {
        return new CommentCollection($card->comments()->whereNull('reply')->orderBy('id', 'DESC')->paginate());
    }

    /**
     * @param StoreCommentsRequest $request
     * @param Cards $card
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCommentsRequest $request, Cards $card)
    {
        $data = $request->validated();
        $data['card_id'] = $card->id;
        $data['platform_id'] = 1; // ID:1 固定為本地平台
        $data['comment_id'] = Str::random(32);
        $data['user_id'] = $request->user()->id;
        $data['user_name'] = $request->user()->name;
        $data['user_avatar'] = $request->user()->avatar;

        $comment = $this->service->store($data);

        return new CommentResource($comment);
    }
}
