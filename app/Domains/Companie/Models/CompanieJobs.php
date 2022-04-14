<?php

namespace App\Domains\Companie\Models;

use App\Domains\Companie\Models\Traits\Method\CompanieJobsMethod;
use App\Domains\Companie\Models\Traits\Relationship\CompanieJobsRelationship;
use App\Models\Traits\Picture;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CompanieJobs.
 */
class CompanieJobs extends Model
{
    use SoftDeletes,
        CompanieJobsMethod,
        CompanieJobsRelationship,
        Picture,
        Uuid;

    /**
     * 職缺類型: 全職
     *
     * @var string
     */
    public const JOB_FULL_TIME = 'Full-time job';

    /**
     * 職缺類型: 兼職
     *
     * @var string
     */
    public const JOB_PART_TIME = 'Part-time job';

    /**
     * 職缺類型: 派遣
     *
     * @var string
     */
    public const JOB_DISPATCHED = 'Dispatched labor';

    /**
     * 職缺類型: 實習
     *
     * @var string
     */
    public const JOB_INTERNSHIP = 'Internship';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'companie_jobs';

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
        'companie_id',
        'name',
        'type',
        'content',
        'pay',
        'publish',
        'publish_at',
        'closure',
        'closure_at',
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
        'content' => 'json',
        'pay' => 'json',
        'publish' => 'boolean',
        'closure' => 'boolean',
        'blockade' => 'boolean',
    ];

    /**
     * The model's default values for attributes.
     *
     * // 內容資訊
     * content => {
     *      // 工作範疇
     *      'scope' => null,
     *      // 工作需求
     *      'require' => null,
     *      // 遠端工作
     *      'remote' => null,
     * },
     * // 薪資範圍
     * pay => {
     *      // 支薪方式
     *      'type' => null,
     *      // 薪資範圍
     *      'amount' => [
     *          // 薪水最低
     *          'min' => null,
     *          // 薪水最高
     *          'max' => null,
     *      ],
     * },
     *
     * @var array
     */
    protected $attributes = [
        'content' => '{
            "scope": null,
            "require": null,
            "remote": null
        }',
        'pay' => '{
            "type": null,
            "amount": {
                "min": null,
                "max": null
            }
        }',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'publish_at',
        'closure_at',
        'blockade_at',
    ];
}
