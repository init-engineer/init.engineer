<?php

namespace App\Models\News\Traits\Relationship;

use App\Models\News\Comments;

/**
 * Class NewsRelationship.
 */
trait NewsRelationship
{
    /**
     * Get all of the owning user models.
     */
    public function model()
    {
        return $this->morphTo();
    }

    /**
     * Get the news for the comment.
     *
     * @return Comments
     */
    public function comments()
    {
        return $this->hasMany(Comments::class, 'news_id', 'id');
    }
}
