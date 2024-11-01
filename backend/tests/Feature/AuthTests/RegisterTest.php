<?php
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

uses(RefreshDatabase::class);

//register 1st test
test('register_valid_input_test', function () {
    
    //sends the test user info
    $response = $this->postJson('/api/auth/register', [
        'first_name' => 'J3fr',
        'last_name' => 'ma7fud',
        'phone_number' => '1234567890',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    //asserts the feedback from the url
    $response->assertStatus(JsonResponse::HTTP_CREATED)
             ->assertJson([
                'success' => true,
                'message' => 'Registered successfully',
                'data'=>[
                    'token_type'=>'bearer',
                    'expires_in'=>Auth::factory()->getTTl()*60,
                    'user' => [
                        'first_name' => 'J3fr',
                        'last_name' => 'ma7fud',
                        'phone_number' => '1234567890',
                     ],
                ],
             ]);
    //check for presence in database         
    $this->assertDatabaseHas('users', [
        'phone_number' => '1234567890',
    ]);
    
});

//register 2nd test
test('register_invalid_phone_test', function () {
    
    //sends the test user info
    $response = $this->postJson('/api/auth/register', [
        'first_name' => 'J3fr',
        'last_name' => 'ma7fud',
        'phone_number' => '123456789',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    //asserts the feedback from the url
    $response->assertStatus(JsonResponse::HTTP_BAD_REQUEST)
            ->assertJson([
                    'success' => false,
                    'message' => 'Invalid Credentials',
             ]);
    
});

