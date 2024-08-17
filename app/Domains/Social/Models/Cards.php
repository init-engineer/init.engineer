<?php

namespace App\Domains\Social\Models;

use App\Domains\Social\Models\Traits\Attribute\CardsAttribute;
use App\Domains\Social\Models\Traits\Method\CardsMethod;
use App\Domains\Social\Models\Traits\Relationship\CardsRelationship;
use App\Domains\Social\Models\Traits\Scope\CardsScope;
use App\Domains\Social\Notifications\Frontend\PublishNotification;
use App\Models\Traits\Config;
use App\Models\Traits\Picture;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * Class Cards.
 */
class Cards extends Model
{
    use Notifiable,
        SoftDeletes,
        CardsAttribute,
        CardsMethod,
        CardsRelationship,
        CardsScope,
        Config,
        Picture,
        Uuid;

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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model_type',
        'model_id',
        'content',
        'config',
        'picture',
        'active',
        'blockade',
        'blockade_by',
        'blockade_remarks',
        'blockade_at',
        'ip_address',
        'user_agent',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'config' => 'json',
        'picture' => 'json',
        'active' => 'boolean',
        'blockade' => 'boolean',
    ];

    /**
     * The model's default values for attributes.
     *
     * // 圖片位址資訊
     * picture => {
     *      // Local 位址
     *      "local": null,
     *      // 雲端位址
     *      "storage": null,
     *      // Imgur 網址
     *      "imgur": null,
     * }
     *
     * @var array
     */
    protected $attributes = [
        'config' => '{}',
        'picture' => '{
            "local": null,
            "storage": null,
            "imgur": null
        }',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'blockade_at',
    ];

    /**
     * Send the publish notification.
     *
     * @return void
     */
    public function sendPublishNotification(): void
    {
        $this->notify(new PublishNotification($this->model, $this));
    }

    /**
     * Route notifications for the mail channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return array|string
     */
    public function routeNotificationForMail($notification)
    {
        return [
            $this->model->email => $this->model->name,
        ];
    }
}
