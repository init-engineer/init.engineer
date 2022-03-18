<?php

namespace App\Domains\Social\Models;

use App\Domains\Social\Models\Traits\Attribute\AdsAttribute;
use App\Domains\Social\Models\Traits\Method\AdsMethod;
use App\Domains\Social\Models\Traits\Relationship\AdsRelationship;
use App\Domains\Social\Models\Traits\Scope\AdsScope;
use App\Models\Traits\Picture;
use App\Models\Traits\Uuid;
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
        AdsAttribute,
        AdsRelationship,
        Picture,
        Uuid;

    /**
     * 分類: 全部 All
     * 全部都會使用。
     *
     * @var string
     */
    public const TYPE_ALL = 'Draw All';

    /**
     * 分類: 橫幅 Banner
     * 圖片插入廣告橫幅。
     *
     * @var string
     */
    public const TYPE_BANNER = 'Draw Banner';

    /**
     * 分類: 內文 Content
     * 文章插入廣告內容。
     *
     * @var string
     */
    public const TYPE_CONTENT = 'Draw Content';

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
        'type',
        'name',
        'content',
        'picture',
        'deploy',
        'probability',
        'render',
        'payment',
        'active',
        'starts_at',
        'ends_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'picture' => 'json',
        'deploy' => 'json',
        'probability' => 'integer',
        'render' => 'boolean',
        'payment' => 'boolean',
        'active' => 'boolean',
    ];

    /**
     * The model's default values for attributes.
     *
     * // 圖片位址資訊
     * picture => {
     *      // Local 位址
     *      "local": null,
     *      // 雲端位址
     *      "storage": null,
     *      // Imgur 網址
     *      "imgur": null,
     * }
     *
     * @var array
     */
    protected $attributes = [
        'picture' => '{
            "local": null,
            "storage": null,
            "imgur": null
        }',
        'deploy' => '{}',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'starts_at',
        'ends_at',
    ];
}
