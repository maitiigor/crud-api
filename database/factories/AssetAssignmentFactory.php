<?php

namespace Database\Factories;

use App\Models\AssetAssignment;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetAssignmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AssetAssignment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'asset_id' => 1,
            'assignment_date' => $this->faker->dateTime('now'),
            'status' => 'active',
            'due_date' => $this->faker->dateTime,
            'assigned_user_id' => 1,
            'assigned_by' => 1,
        ];
    }
}
