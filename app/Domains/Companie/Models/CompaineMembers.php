<?php

namespace App\Domains\Companie\Models;

use App\Domains\Companie\Models\Traits\Relationship\CompanieMembersRelationship;
use App\Models\Traits\Picture;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CompanieMembers.
 */
class CompanieMembers extends Model
{
    use SoftDeletes,
        CompanieMembersRelationship,
        Picture,
        Uuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'companie_members';

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
        'picture',
        'name',
        'office',
        'about',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'picture' => 'json',
    ];
}
