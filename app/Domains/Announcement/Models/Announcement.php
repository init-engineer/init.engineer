<?php

namespace App\Domains\Announcement\Models;

use App\Domains\Announcement\Models\Traits\Method\AnnouncementMethod;
use App\Domains\Announcement\Models\Traits\Scope\AnnouncementScope;
use Database\Factories\AnnouncementFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Announcement.
 *
 * @extends Model
 */
class Announcement extends Model
{
    use AnnouncementScope,
        AnnouncementMethod,
        HasFactory,
        LogsActivity;

    /**
     * 列舉 area 作用區域
     * Frontend 前台
     *
     * @var string
     */
    public const AREA_FRONTEND = 'frontend';

    /**
     * 列舉 area 作用區域
     * Backend 後台
     *
     * @var string
     */
    public const AREA_BACKEND = 'backend';

    /**
     * 列舉 type 分類
     * primary
     *
     * @var string
     */
    public const TYPE_PRIMARY = 'primary';

    /**
     * 列舉 type 分類
     * secondary
     *
     * @var string
     */
    public const TYPE_SECONDARY = 'secondary';

    /**
     * 列舉 type 分類
     * success
     *
     * @var string
     */
    public const TYPE_SUCCESS = 'success';

    /**
     * 列舉 type 分類
     * danger
     *
     * @var string
     */
    public const TYPE_DANGER = 'danger';

    /**
     * 列舉 type 分類
     * warning
     *
     * @var string
     */
    public const TYPE_WARNING = 'warning';

    /**
     * 列舉 type 分類
     * info
     *
     * @var string
     */
    public const TYPE_INFO = 'info';

    /**
     * 列舉 type 分類
     * light
     *
     * @var string
     */
    public const TYPE_LIGHT = 'light';

    /**
     * 列舉 type 分類
     * dark
     *
     * @var string
     */
    public const TYPE_DARK = 'dark';

    /**
     * @var bool
     */
    protected static $logFillable = true;

    /**
     * @var bool
     */
    protected static $logOnlyDirty = true;

    /**
     * @var string[]
     */
    protected $fillable = [
        'area',
        'type',
        'message',
        'enabled',
        'starts_at',
        'ends_at',
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'starts_at',
        'ends_at',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'enabled' => 'boolean',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return AnnouncementFactory::new();
    }
}
