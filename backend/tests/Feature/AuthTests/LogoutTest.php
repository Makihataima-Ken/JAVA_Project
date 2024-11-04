<?php
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

uses(RefreshDatabase::class);

test('logout_test', function () {

    // Mock the Auth facade to simulate a logged-in user
    //Auth::shouldReceive('logout')->once();

    //-----------------------------------------------
    $user = User::factory()->create();// Create a user and authenticate
    $this->actingAs($user);//imitate a logged in user
    //------------------------------------------------

    // Call the logout method
    $response = $this->postJson('/api/auth/logout'); 

    // Assert the response
    $response->assertStatus(200)
             ->assertJson([
                 'message' => 'logged out successfully',
             ]);
});
