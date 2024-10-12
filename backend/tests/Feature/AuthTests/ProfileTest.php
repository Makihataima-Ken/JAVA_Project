<?php
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

uses(RefreshDatabase::class);
test('Profile_test', function () {

    // Create a user
    $user = User::create([
        'name' => 'J3fr',
        'lastname' => 'ma7fud',
        'phone' => '1234567890', 
        'password' => bcrypt('validpassword'),  // Encrypt password
    ]);

    $response = $this->get('/api/auth/profile');

    $response->assertStatus(JsonResponse::HTTP_OK);
});
