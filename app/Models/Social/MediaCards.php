<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Social\Traits\Scope\MediaCardsScope;
use App\Models\Social\Traits\Method\MediaCardsMethod;

/**
 * Class MediaCards.
 */
class MediaCards extends Model
{
    use SoftDeletes,
        MediaCardsScope,
        MediaCardsMethod;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'social_media_cards';

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
        'id',
        'card_id',
        'model_type',
        'model_id',
        'social_type',
        'social_connections',
        'social_card_id',
        'num_like',
        'num_share',
        'active',
        'is_banned',
        'banned_user_id',
        'banned_remarks',
        'banned_at',
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
        'banned_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
