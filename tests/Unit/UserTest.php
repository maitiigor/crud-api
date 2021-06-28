<?php

namespace Tests\Unit;


use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */


    public function test_can_user_register(){
        //$user = $this->$this->faker->;
        //$this->actingAs($user,'api');
        $this->withoutExceptionHandling();
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $data = [
            'first_name' => 'james',
            'middle_name' => 'john',
            'last_name' => 'mattew',
            'email' => 'user1@gmail.com',
            'password' => 'password',
            'picture' => $file,
            'phone_number' => '80563589',
            'c_password' => 'password',
            ];

        $this->json('POST','/api/auth/register',$data)->assertStatus(201);

    }
    public function test_can_user_login(){
        $data = [
            'email' => 'user1@gmail.com',
            'password' => 'password',
        ];

        $this->json('POST','api/auth/login',$data)->assertStatus(200);
    }
    public function test_can_user_update(){
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user,'api');
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar1.jpg');
        $data = [
            'first_name' => 'lolly',
            'middle_name' => 'Brian',
            'last_name' => 'Mattew',
            'phone_number' => '8056357',


        ];

        $this->json('PATCH','api/update_user/1',$data)->assertStatus(201);
    }
    public function test_can_user_fetch(){
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user,'api');

        $this->json('GET',route('view.user'))->assertJsonStructure(['details']);

    }
    public function test_can_user_delete(){
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user,'api');

        $this->json('DELETE','api/delete_user/1')->assertJsonStructure(['success']);
    }
}
