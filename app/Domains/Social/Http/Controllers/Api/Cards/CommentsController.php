<?php

namespace App\Domains\Social\Http\Controllers\Api\Cards;

use App\Domains\Social\Http\Resources\CommentCollection;
use App\Domains\Social\Models\Cards;
use App\Domains\Social\Services\CommentsService;
use App\Http\Controllers\Controller;

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
}
