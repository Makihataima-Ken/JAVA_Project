<?php
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

uses(RefreshDatabase::class);
test('Profile_test', function () {

    // Create a user
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/api/auth/profile');

    $response->assertStatus(JsonResponse::HTTP_OK)
        ->assertJson([
            'success'=>true,
            'message'=>'User Profile',
        ]);
});
