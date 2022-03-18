<?php

namespace App\Domains\Social\Models;

use App\Domains\Social\Models\Traits\Relationship\ReviewRelationship;
use App\Domains\Social\Models\Traits\Scope\ReviewsScope;
use App\Models\Traits\Config;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Reviews.
 */
class Reviews extends Model
{
    use SoftDeletes,
        ReviewsScope,
        ReviewRelationship,
        Config,
        Uuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'social_cards_reviews';

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
        'card_id',
        'point',
        'config',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'point' => 'integer',
        'config' => 'json',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'config' => '{}',
    ];
}
