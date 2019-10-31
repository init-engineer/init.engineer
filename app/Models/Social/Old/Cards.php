<?php

namespace App\Models\Social\Old;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cards.
 */
class Cards extends Model
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
    protected $table = 'social_cards';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the image with the model.
     *
     * @return Image
     */
    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'cards_image_id');
    }

    /**
     * Get the comments for the card.
     *
     * @return Comments
     */
    public function comments()
    {
        return $this->hasMany(Comments::class, 'card_id', 'id');
    }
}
