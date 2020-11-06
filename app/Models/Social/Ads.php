<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Social\Traits\Scope\AdsScope;
use App\Models\Social\Traits\Method\AdsMethod;
use App\Models\Social\Traits\Attribute\AdsAttribute;
use App\Models\Social\Traits\Relationship\AdsRelationship;

/**
 * Class Ads.
 */
class Ads extends Model
{
    use SoftDeletes,
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
        'name',
        'ads_path',
        'number_count',
        'number_max',
        'incidence',
        'active',
        'options',
        'started_at',
        'end_at',
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
        'active' => 'boolean',
        'incidence' => 'integer',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'started_at',
        'end_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
