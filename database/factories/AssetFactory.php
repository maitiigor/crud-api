<?php

namespace Database\Factories;

use App\Models\Asset;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Asset::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'type' => $this->faker->name(),
            'serial_number' => $this->faker->randomDigit(),
            'description' => $this->faker->sentence(6,false),
            'fixed_or_movable' => 'fixed',
            'current_value_in_naira' => '500000',
            'purchase_expiry_date' => Carbon::parse(05/01/2022),
            'picture_path' => $this->faker->image('public/images',640,480,null,true),
            'purchase_date' => Carbon::parse(05/01/2020),
            'start_use_date' => Carbon::parse(05/01/2020),
            'purchase_price' => $this->faker->randomDigitNotNull, // password
            'warranty_expiry_date' => Carbon::parse(05/01/2022),
            'degradation_in_years' => 1,
            'location' => $this->faker->address,
        ];
    }
}
