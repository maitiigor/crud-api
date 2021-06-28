<?php

namespace Tests\Unit;

use App\Events;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Testcase;

class TestVendor extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_can_vendor_create(){
        $data = [
            'Name' => $this->faker->name,
            'category' => $this->faker->category,
        ];

        $this->json('POST','/api/vendor_create',$data);
    }
    public function test_can_vendor_fetch(){
        Vendor::factory()->create();
        $this->json('GET','api/vendor_create')->assertStatus(201);
    }
    public function test_can_vendor_delete(){
        $vendor = Vendor::factory()->create();
        $this->json('DELETE','api/vendor_delete/'.$vendor->id)->assertStatus(201);
    }
    public function test_can_vendor_update(){
        $vendor = Vendor::factory()->create();
        $data = [
            'Name' => $this->faker->name,
            'category' => $this->faker->category,
        ];
        $this->json('PATCH','api/vendor_update/'.$vendor->id,$data)->assertStatus(201);
    }


}
