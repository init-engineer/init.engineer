<?php

namespace App\Domains\Companie\Models;

use App\Domains\Companie\Models\Traits\Method\CompaniesMethod;
use App\Domains\Companie\Models\Traits\Relationship\CompaniesRelationship;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Companies.
 */
class Companies extends Model
{
    use SoftDeletes,
        CompaniesMethod,
        CompaniesRelationship,
        Uuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'companies';

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
        'logo',
        'banner',
        'pictures',
        'area',
        'address',
        'scale',
        'tax',
        'capital',
        'email',
        'phone',
        'description',
        'content',
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
        'logo' => 'json',
        'banner' => 'json',
        'pictures' => 'json',
        'scale' => 'integer',
        'content' => 'json',
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
