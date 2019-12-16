<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\News\Traits\Scope\NewsScope;
use App\Models\News\Traits\Method\NewsMethod;
use App\Models\News\Traits\Attribute\NewsAttribute;
use App\Models\News\Traits\Relationship\NewsRelationship;

/**
 * Class News.
 */
class News extends Model
{
    use SoftDeletes,
        NewsScope,
        NewsMethod,
        NewsAttribute,
        NewsRelationship;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news';

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
        'title',
        'image',
        'content',
        'url',
        'hashtag',
        'layout',
        'viewer',
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
