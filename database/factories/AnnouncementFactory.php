<?php

namespace Database\Factories;

use App\Domains\Announcement\Models\Announcement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class AnnouncementFactory.
 *
 * @extends Factory
 */
class AnnouncementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Announcement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'area' => $this->faker->randomElement([
                Announcement::AREA_FRONTEND,
                Announcement::AREA_BACKEND,
            ]),
            'type' => $this->faker->randomElement([
                Announcement::TYPE_PRIMARY,
                Announcement::TYPE_SECONDARY,
                Announcement::TYPE_SUCCESS,
                Announcement::TYPE_DANGER,
                Announcement::TYPE_WARNING,
                Announcement::TYPE_INFO,
                Announcement::TYPE_LIGHT,
                Announcement::TYPE_DARK,
            ]),
            'message' => $this->faker->text,
            'enabled' => $this->faker->boolean,
            'starts_at' => $this->faker->dateTime(),
            'ends_at' => $this->faker->dateTime(),
        ];
    }

    /**
     * @return AnnouncementFactory
     */
    public function enabled(): AnnouncementFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'enabled' => true,
            ];
        });
    }

    /**
     * @return AnnouncementFactory
     */
    public function disabled(): AnnouncementFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'enabled' => false,
            ];
        });
    }

    /**
     * @return AnnouncementFactory
     */
    public function frontend(): AnnouncementFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'area' => Announcement::AREA_FRONTEND,
            ];
        });
    }

    /**
     * @return AnnouncementFactory
     */
    public function backend(): AnnouncementFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'area' => Announcement::AREA_BACKEND,
            ];
        });
    }

    /**
     * @return AnnouncementFactory
     */
    public function global(): AnnouncementFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'area' => null,
            ];
        });
    }

    /**
     * @return AnnouncementFactory
     */
    public function noDates(): AnnouncementFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'starts_at' => null,
                'ends_at' => null,
            ];
        });
    }

    /**
     * @return AnnouncementFactory
     */
    public function insideDateRange(): AnnouncementFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'starts_at' => now()->subWeek(),
                'ends_at' => now()->addWeek(),
            ];
        });
    }

    /**
     * @return AnnouncementFactory
     */
    public function outsideDateRange(): AnnouncementFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'starts_at' => now()->subWeeks(2),
                'ends_at' => now()->subWeek(),
            ];
        });
    }
}
