<?php

namespace App\Models\Social;

use App\Models\Social\Traits\Method\CommentsMethod;
use App\Models\Social\Traits\Relationship\CommentsRelationship;
use App\Models\Social\Traits\Scope\CommentsScope;
use Arcanedev\Support\Database\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comments.
 */
class Comments extends Model
{
    use SoftDeletes,
        CommentsScope,
        CommentsMethod,
        CommentsRelationship;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'social_comments';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'card_id',
        'token_id',
        'comment_id',
        'user_name',
        'user_id',
        'user_avatar',
        'content',
        'active',
        'reply',
        'banned',
        'banned_by',
        'banned_remarks',
        'banned_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
        'banned' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'banned_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
