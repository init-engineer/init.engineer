<?php

namespace App\Domains\Social\Models;

use App\Domains\Social\Models\Traits\Method\PlatformMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Platform.
 */
class Platform extends Model
{
    use SoftDeletes,
        PlatformMethod;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'social_platform';

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
        'type',
        'active',
        'config',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
    ];
}
