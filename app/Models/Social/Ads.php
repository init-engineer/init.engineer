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
     * 分類: 全部 All
     * 全部都會使用。
     *
     * @var string
     */
    public const TYPE_ALL = 'all';

    /**
     * 分類: 橫幅 Banner
     * 圖片插入廣告橫幅。
     *
     * @var string
     */
    public const TYPE_BANNER = 'banner';

    /**
     * 分類: 內文 Content
     * 文章插入廣告內容。
     *
     * @var string
     */
    public const TYPE_CONTENT = 'content';

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
        'id',
        'type',
        'name',
        'content',
        'ads_path',
        'number_count',
        'number_max',
        'incidence',
        'active',
        'render',
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
        'render' => 'boolean',
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
