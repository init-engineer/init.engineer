<?php

namespace App\Domains\Social\Models;

use App\Domains\Social\Models\Traits\Method\AdsMethod;
use App\Domains\Social\Models\Traits\Relationship\AdsRelationship;
use App\Domains\Social\Models\Traits\Scope\AdsScope;
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
        'active',
        'started_at',
        'end_at',
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
        'active' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'started_at',
        'end_at',
    ];
}
