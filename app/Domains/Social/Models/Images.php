<?php

namespace App\Domains\Social\Models;

use App\Domains\Social\Models\Traits\Method\ImagesMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'storage',
        'path',
        'name',
        'type',
        'active',
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
