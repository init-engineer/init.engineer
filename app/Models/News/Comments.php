<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\News\Traits\Scope\CommentsScope;
use App\Models\News\Traits\Method\CommentsMethod;
use App\Models\News\Traits\Attribute\CommentsAttrivute;
use App\Models\News\Traits\Relationship\CommentsRelationship;

/**
 * Class Comments.
 */
class Comments extends Model
{
    use SoftDeletes,
        CommentsScope,
        CommentsMethod,
        CommentsAttrivute,
        CommentsRelationship;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news_comments';

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
        'model_type',
        'model_id',
        'content',
        'active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
