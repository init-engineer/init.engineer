<?php

namespace App\Domains\Social\Models;

use App\Domains\Social\Models\Traits\Method\PlatformMethod;
use App\Domains\Social\Models\Traits\Scope\PlatformScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Platform.
 */
class Platform extends Model
{
    use SoftDeletes,
        PlatformScope,
        PlatformMethod;

    public const PLATFORM_PRIMARY = 'primary';
    public const PLATFORM_SECONDARY = 'secondary';
    public const PLATFORM_TESTING = 'testing';

    public const TYPE_LOCAL = 'local';
    public const TYPE_FACEBOOK = 'facebook';
    public const TYPE_TWITTER = 'twitter';
    public const TYPE_PLURK = 'plurk';

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
