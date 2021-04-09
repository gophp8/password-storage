<?php

namespace Database\Factories;

use App\Libraries\Hashing;
use App\Models\PasswordHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PasswordHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PasswordHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $salt = Hashing::generateSalt();

        return [
            'password' => Hashing::encryptPassword($this->faker->password, $salt),
            'salt' => $salt
        ];
    }
}
