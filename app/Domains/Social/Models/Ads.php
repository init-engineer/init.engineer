<?php

namespace App\Domains\Social\Models;

use App\Domains\Social\Models\Traits\Attribute\AdsAttribute;
use App\Domains\Social\Models\Traits\Method\AdsMethod;
use App\Domains\Social\Models\Traits\Relationship\AdsRelationship;
use App\Domains\Social\Models\Traits\Scope\AdsScope;
use App\Models\Traits\Picture;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Ads.
 */
class Ads extends Model
{
    use SoftDeletes,
        AdsScope,
        AdsMethod,
        AdsAttribute,
        AdsRelationship,
        Picture,
        Uuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'social_cards_ads';

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
        'name',
        'picture',
        'probability',
        'payment',
        'active',
        'starts_at',
        'ends_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'probability' => 'integer',
        'payment' => 'boolean',
        'active' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'starts_at',
        'ends_at',
    ];
}
