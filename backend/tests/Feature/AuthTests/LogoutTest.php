<?php
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

uses(RefreshDatabase::class);

test('logout_test', function () {

    // Mock the Auth facade to simulate a logged-in user
    Auth::shouldReceive('logout')->once();

    // Call the logout method
    $response = $this->postJson('/api/auth/logout'); 

    // Assert the response
    $response->assertStatus(200)
             ->assertJson([
                 'message' => 'logged out successfully',
             ]);
});
