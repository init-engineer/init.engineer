<?php

namespace App\Domains\Companie\Models;

use App\Domains\Companie\Models\Traits\Relationship\CompanieLinksRelationship;
use App\Models\Traits\Picture;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CompanieLinks.
 */
class CompanieLinks extends Model
{
    use SoftDeletes,
        CompanieLinksRelationship,
        Picture,
        Uuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'companie_links';

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
        'icon',
        'url',
    ];
}
