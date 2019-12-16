<?php

namespace App\Models\News\Traits\Relationship;

use App\Models\News\News;

/**
 * Class CommentsRelationship.
 */
trait CommentsRelationship
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
     * @return News
     */
    public function news()
    {
        return $this->hasOne(News::class, 'id', 'news_id');
    }
}
