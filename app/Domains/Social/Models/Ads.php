<?php

namespace App\Domains\Social\Models;

use App\Domains\Social\Models\Traits\Attribute\AdsAttribute;
use App\Domains\Social\Models\Traits\Method\AdsMethod;
use App\Domains\Social\Models\Traits\Relationship\AdsRelationship;
use App\Domains\Social\Models\Traits\Scope\AdsScope;
use App\Models\Traits\Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Ads.
 */
class Ads extends Model
{
    use SoftDeletes,
        Profile,
        AdsScope,
        AdsMethod,
        AdsAttribute,
        AdsRelationship;

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
        'ads_path',
        'number_max',
        'number_min',
        'incidence',
        'payment',
        'active',
        'started_at',
        'ended_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'number_max' => 'integer',
        'number_min' => 'integer',
        'incidence' => 'integer',
        'payment' => 'boolean',
        'active' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'started_at',
        'ended_at',
    ];
}
