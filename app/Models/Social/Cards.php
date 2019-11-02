<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Social\Traits\Scope\CardsScope;
use App\Models\Social\Traits\Method\CardsMethod;
use App\Models\Social\Traits\Attribute\CardsAttribute;
use App\Models\Social\Traits\Relationship\CardsRelationship;

/**
 * Class Cards.
 */
class Cards extends Model
{
    use SoftDeletes,
        CardsScope,
        CardsMethod,
        CardsAttribute,
        CardsRelationship;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'social_cards';

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
        'model_type',
        'model_id',
        'content',
        'active',
        'is_banned',
        'banned_user_id',
        'banned_remarks',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the media for the card.
     *
     * @return Media
     */
    public function media()
    {
        return $this->hasMany(MediaCards::class, 'card_id', 'id');
    }

    /**
     * Get the images for the card.
     *
     * @return Images
     */
    public function images()
    {
        return $this->hasMany(Images::class, 'card_id', 'id');
    }

    /**
     * Get the comments for the card.
     *
     * @return Comments
     */
    public function comments()
    {
        return $this->hasMany(Comments::class, 'card_id', 'id');
    }
}
