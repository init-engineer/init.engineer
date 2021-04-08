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
 * @property int $id
 * @property string|null $area
 * @property string $type
 * @property string $message
 * @property bool $enabled
 * @property \Illuminate\Support\Carbon|null $starts_at
 * @property \Illuminate\Support\Carbon|null $ends_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement forArea($area)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement inTimeFrame()
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereStartsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereUpdatedAt($value)
 * @mixin \Eloquent
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
     */
    public const AREA_FRONTEND = 'frontend';

    /**
     * 列舉 area 作用區域
     * Backend 後台
     */
    public const AREA_BACKEND = 'backend';

    /**
     * 列舉 type 分類
     * primary
     */
    public const TYPE_PRIMARY = 'primary';

    /**
     * 列舉 type 分類
     * secondary
     */
    public const TYPE_SECONDARY = 'secondary';

    /**
     * 列舉 type 分類
     * success
     */
    public const TYPE_SUCCESS = 'success';

    /**
     * 列舉 type 分類
     * danger
     */
    public const TYPE_DANGER = 'danger';

    /**
     * 列舉 type 分類
     * warning
     */
    public const TYPE_WARNING = 'warning';

    /**
     * 列舉 type 分類
     * info
     */
    public const TYPE_INFO = 'info';

    /**
     * 列舉 type 分類
     * light
     */
    public const TYPE_LIGHT = 'light';

    /**
     * 列舉 type 分類
     * dark
     */
    public const TYPE_DARK = 'dark';

    protected static $logFillable = true;
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
