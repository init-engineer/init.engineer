<?php

namespace App\Domains\Social\Models;

use App\Domains\Social\Models\Traits\Method\PlatformMethod;
use App\Domains\Social\Models\Traits\Scope\PlatformScope;
use App\Models\Traits\Config;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Platform.
 */
class Platform extends Model
{
    use SoftDeletes,
        PlatformScope,
        PlatformMethod,
        Config,
        Uuid;

    /**
     * 行為: 不做任何事 inaction
     */
    public const ACTION_INACTION = 'inaction';

    /**
     * 行為: 通知 notification
     * 有新的文章被投稿時，將進行通知的行為。
     *
     * @var string
     */
    public const ACTION_NOTIFICATION = 'notification';

    /**
     * 行為: 發佈 publish
     * 有文章被審核通過時，將進行發佈的行為。
     *
     * @var string
     */
    public const ACTION_PUBLISH = 'publish';

    /**
     * 分類: 本地 local
     *
     * @var string
     */
    public const TYPE_LOCAL = 'local';

    /**
     * 分類: 本地 facebook
     *
     * @var string
     */
    public const TYPE_FACEBOOK = 'facebook';

    /**
     * 分類: 本地 twitter
     *
     * @var string
     */
    public const TYPE_TWITTER = 'twitter';

    /**
     * 分類: 本地 plurk
     *
     * @var string
     */
    public const TYPE_PLURK = 'plurk';

    /**
     * 分類: 本地 discord
     *
     * @var string
     */
    public const TYPE_DISCORD = 'discord';

    /**
     * 分類: 本地 tumblr
     *
     * @var string
     */
    public const TYPE_TUMBLR = 'tumblr';

    /**
     * 分類: 本地 telegram
     *
     * @var string
     */
    public const TYPE_TELEGRAM = 'telegram';

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
        'action',
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
