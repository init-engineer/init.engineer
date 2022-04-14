<?php

namespace App\Domains\Crons\Models;

use App\Domains\Crons\Models\Traits\Method\CronsMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Crons.
 */
class Crons extends Model
{
    use SoftDeletes,
        CronsMethod;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'crons';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'command';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'command',
        'next_run',
        'last_run',
    ];
}
