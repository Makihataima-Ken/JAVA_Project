<?php
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

uses(RefreshDatabase::class);
test('Profile_test', function () {

    //-----------------------------------------------
    $user = User::factory()->create();// Create a user and authenticate
    $this->actingAs($user);//imitate a logged in user
    //------------------------------------------------

    $response = $this->get('/api/auth/profile');

    $response->assertStatus(JsonResponse::HTTP_OK)
        ->assertJson([
            'success'=>true,
            'message'=>'User Profile',
        ]);
});
