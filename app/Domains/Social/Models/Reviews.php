<?php

namespace App\Domains\Social\Models;

use App\Domains\Social\Models\Traits\Relationship\ReviewRelationship;
use App\Domains\Social\Models\Traits\Scope\ReviewsScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Reviews.
 */
class Reviews extends Model
{
    use SoftDeletes,
        ReviewsScope,
        ReviewRelationship;

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
        'card_id',
        'model_type',
        'model_id',
        'point',
        'config',
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
        'point' => 'integer',
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
