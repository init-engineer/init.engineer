<?php

namespace App\Models\Social\Old;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comments.
 */
class Comments extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql_old';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'social_comments';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
