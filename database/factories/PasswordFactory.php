<?php

namespace Database\Factories;

use App\Libraries\Hashing;
use App\Models\Password;
use Illuminate\Database\Eloquent\Factories\Factory;

class PasswordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Password::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $salt = Hashing::generateSalt();

        return [
            'label' => $this->faker->name,
            'description' => $this->faker->text,
            'password' => Hashing::encryptPassword($this->faker->password, $salt),
            'salt' => $salt
        ];
    }
}
