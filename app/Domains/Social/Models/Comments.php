<?php

namespace App\Domains\Social\Models;

use App\Domains\Social\Models\Traits\Method\CommentsMethod;
use App\Domains\Social\Models\Traits\Relationship\CommentsRelationship;
use App\Domains\Social\Models\Traits\Scope\CommentsScope;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comments.
 */
class Comments extends Model
{
    use SoftDeletes,
        CommentsScope,
        CommentsMethod,
        CommentsRelationship,
        Uuid;

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
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'card_id',
        'platform_id',
        'platform_card_id',
        'comment_id',
        'user_name',
        'user_id',
        'user_avatar',
        'content',
        'active',
        'reply',
        'blockade',
        'blockade_by',
        'blockade_remarks',
        'blockade_at',
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
        'blockade' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'blockade_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
