<?php

namespace Database\Factories;

use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Class UserFactory.
 *
 * @extends Factory
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return array(
            'type' => $this->faker->randomElement(array(
                User::TYPE_ADMIN,
                User::TYPE_USER,
            )),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => 'secret',
            'password_changed_at' => null,
            'remember_token' => Str::random(10),
            'active' => true,
        );
    }

    /**
     * @return UserFactory
     */
    public function admin(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return array(
                'type' => User::TYPE_ADMIN,
            );
        });
    }

    /**
     * @return UserFactory
     */
    public function user(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return array(
                'type' => User::TYPE_USER,
            );
        });
    }

    /**
     * @return UserFactory
     */
    public function active(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return array(
                'active' => true,
            );
        });
    }

    /**
     * @return UserFactory
     */
    public function inactive(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return array(
                'active' => false,
            );
        });
    }

    /**
     * @return UserFactory
     */
    public function confirmed(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return array(
                'email_verified_at' => now(),
            );
        });
    }

    /**
     * @return UserFactory
     */
    public function unconfirmed(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return array(
                'email_verified_at' => null,
            );
        });
    }

    /**
     * @return UserFactory
     */
    public function passwordExpired(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return array(
                'password_changed_at' => now()->subYears(5),
            );
        });
    }

    /**
     * @return UserFactory
     */
    public function deleted(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return array(
                'deleted_at' => now(),
            );
        });
    }
}
