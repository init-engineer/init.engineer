<?php

namespace App\Models\Social;

use App\Models\Social\Traits\Method\CardPostMethod;
use App\Models\Social\Traits\Relationship\CardPostRelationship;
use App\Models\Social\Traits\Scope\CardPostScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CardPost.
 */
class CardPost extends Model
{
    use SoftDeletes,
        CardPostScope,
        CardPostMethod,
        CardPostRelationship;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'social_cards_post';

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
        'platform_id',
        'social_card_id',
        'num_like',
        'num_share',
        'active',
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
        'num_like' => 'integer',
        'num_share' => 'integer',
        'active' => 'boolean',
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
