<?php

namespace Tests\Unit;

use App\Models\Asset;
use App\Models\AssetAssignment;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;


class AssetAssignmentTest extends TestCase
{   use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_can_create_assetAssignment(){
        $user = User::factory()->create();
        $asset = Asset::factory()->create();
        $vendor = Vendor::factory()->create();
        $this->withExceptionHandling();

        $this->actingAs($user,'api');
        $data = [
            'asset_id' => $asset->id,
            'assignment_date' => '04/05/20',
            'status' => 'active',
            'due_date' => '05/05/20',
            'assigned_user_id' => $vendor->id,


        ];


        $this->json('POST',route('asset.assignment.create'),$data)->assertStatus(201);

    }
    public function test_can_assetAssignment_fetch(){
        $user = User::factory()->create();
        $this->actingAs($user,'api');

        Asset::factory()->create();
        Vendor::factory()->create();
        AssetAssignment::factory()->create();
        $this->json('GET','api/asset_assignment_fetch')->assertStatus(201);
    }
    public function test_can_assetAssignment_update(){
        $user = User::factory()->create();
        $asset = Asset::factory()->create();

        $vendor = Vendor::factory()->create();
        $asset_assignment = AssetAssignment::factory()->create();
        $this->withExceptionHandling();
        $this->withoutMiddleware();
        $this->actingAs($user,'api');
        $data = [
            'asset_id' => $asset->id,
            'assignment_date' => '04/05/21',
            'status' => 'active',
            'due_date' => '05/05/20',
            'assigned_user_id' => $vendor->id,

        ];
        $this->json('PATCH','api/asset_assignment_update/'.$asset_assignment->id,$data)->assertStatus(201);
    }
    public function test_can_assetAssignment_delete(){
        $user = User::factory()->create();
        Asset::factory()->create();
        Vendor::factory()->create();
        AssetAssignment::factory()->create();
        $this->withExceptionHandling();
        $this->actingAs($user,'api');

        $this->json('DELETE',route('asset.assignment.delete',1))->assertStatus(201);
    }
}
