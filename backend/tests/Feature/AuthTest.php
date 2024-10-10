<?php
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;

uses(RefreshDatabase::class);

//register 1st test
test('register_valid_input_test', function () {
    
    //sends the test user info
    $response = $this->postJson('/api/auth/register', [
        'name' => 'J3fr',
        'lastname' => 'ma7fud',
        'phone' => '1234567890',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    //asserts the feedback from the url
    $response->assertStatus(JsonResponse::HTTP_CREATED)
             ->assertJson([
                 'message' => 'registered successfully',
                 'user' => [
                     'name' => 'J3fr',
                     'lastname' => 'ma7fud',
                     'phone' => '1234567890',
                 ],
             ]);
    //check for presence in database         
    $this->assertDatabaseHas('users', [
        'phone' => '1234567890',
    ]);
    
});

//login 1st test
test('login_valid_input_test', function () {

        // Create a user
        $user = User::create([
            'name' => 'J3fr',
            'lastname' => 'ma7fud',
            'phone' => '1234567890', 
            'password' => bcrypt('validpassword'),  // Encrypt password
        ]);

        /// Attempt login with a phone number that doesn't exist
        $response = $this->postJson('/api/auth/login', [
            'phone' => '0987654321',  // Non-existent phone
            'password' => 'validpassword',
        ]);

        $response->assertStatus(422);

});
