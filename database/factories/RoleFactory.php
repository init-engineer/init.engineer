<?php

namespace Database\Factories;

use App\Domains\Auth\Models\Role;
use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class RoleFactory.
 *
 * @extends Factory
 */
class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

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
            'name' => $this->faker->word,
        );
    }
}
