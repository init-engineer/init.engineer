<?php

namespace App\Domains\Social\Models;

use App\Domains\Social\Models\Traits\Method\CardsMethod;
use App\Domains\Social\Models\Traits\Relationship\CardsRelationship;
use App\Domains\Social\Models\Traits\Scope\CardsScope;
use App\Models\Traits\Config;
use App\Models\Traits\Picture;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cards.
 */
class Cards extends Model
{
    use SoftDeletes,
        CardsScope,
        CardsMethod,
        CardsRelationship,
        Config,
        Picture,
        Uuid;

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
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model_type',
        'model_id',
        'content',
        'config',
        'picture',
        'active',
        'blockade',
        'blockade_by',
        'blockade_remarks',
        'blockade_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'config' => 'json',
        'picture' => 'json',
        'active' => 'boolean',
        'blockade' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'blockade_at',
    ];
}
