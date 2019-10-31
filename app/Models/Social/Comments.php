<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comments.
 */
class Comments extends Model
{
    use SoftDeletes;

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
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'card_id',
        'media_id',
        'media_comment_id',
        'user_name',
        'user_id',
        'user_avatar',
        'content',
        'active',
        'reply_media_comment_id',
        'is_banned',
        'banned_user_id',
        'banned_remarks',
    ];
}
