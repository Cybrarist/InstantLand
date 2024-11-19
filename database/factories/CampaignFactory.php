<?php

namespace Database\Factories;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->name(),
            "link" => $this->faker->unique()->slug(),
            "description" => $this->faker->text(),
            "start_at" => today()->addDays(random_int(1,1000)),
            "end_at" => today()->addDays(random_int(1,1000)),
            "status" => $this->faker->randomElement(StatusEnum::class),
            "user_id" => 1,

        ];
    }
}
