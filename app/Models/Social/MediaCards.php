<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MediaCards.
 */
class MediaCards extends Model
{
    use SoftDeletes;

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
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
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
    ];
}
