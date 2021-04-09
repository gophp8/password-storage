<?php
namespace Database\Factories;

use App\Models\MasterSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

class MasterSettingFactory extends Factory
{
    protected $model = MasterSetting::class;

    public function definition()
    {
        return [
            'key' => $this->faker->name,
            'value' => $this->faker->name,
        ];
    }
}
