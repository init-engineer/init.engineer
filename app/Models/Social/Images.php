<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Social\Traits\Method\ImagesMethod;

/**
 * Class Images.
 */
class Images extends Model
{
    use SoftDeletes,
        ImagesMethod;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'card_images';

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
        'card_id',
        'model_type',
        'model_id',
        'storage',
        'avatar_path',
        'avatar_name',
        'avatar_type',
        'active',
        'is_banned',
        'banned_user_id',
        'banned_remarks',
        'banned_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'banned_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
