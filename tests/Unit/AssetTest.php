<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Route;
use Tests\TestCase;
use App\Models\Asset;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssetTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }
    public function test_can_create_asset(){
        $user = User::factory()->create();
        $this->actingAs($user,'api');

        $data = [
            'type' => 'Freezers',
            'serial_number' => $this->faker->randomDigit(),
            'description' => $this->faker->sentence(6,false),
            'fixed_or_movable' => 'fixed',
            'current_value_in_naira' => '550000',
            'picture_path' => UploadedFile::fake()->image('avatar1.jpg'),
            'purchase_date' => '01-05-2021',
            'start_use_date' => '01/05/2021',
            'purchase_price' => $this->faker->randomDigitNotNull,
            'warranty_expiry_date' => '05/05/2022',
            'degradation_in_years' => 1,
            'location' => $this->faker->address,
        ];
        $this->json('POST','/api/create_asset',$data)->assertStatus(201);

    }

    public function test_can_fetch_asset(){

        Asset::factory()->create();
        $this->json('GET', 'api/asset_fetch')->assertJsonStructure([
            'fetch' ,
        ]);
    }
    public function test_can_update_asset(){
        $asset = Asset::factory()->create();
        $data = [
            'type' => 'Freezers',
            'serial_number' => $this->faker->randomDigit(),
            'description' => $this->faker->sentence(6,false),
            'fixed_or_movable' => 'fixed',
            'current_value_in_naira' => '550000',
            'picture_path' => UploadedFile::fake()->image('avatar1.jpg'),
            'purchase_date' => '01-05-2021',
            'start_use_date' => '01/05/2021',
            'purchase_price' => $this->faker->randomDigitNotNull,
            'warranty_expiry_date' => '05/05/2022',
            'degradation_in_years' => 1,
            'location' => $this->faker->address,
        ];

        $this->json('PATCH','api/asset_update/'.$asset->id,$data)->assertStatus(201);
    }
    public function test_can_asset_delete(){

        $asset = Asset::factory()->create();

        $this->json('DELETE','api/asset_delete/'.$asset->id)->assertStatus(201);
    }
}
