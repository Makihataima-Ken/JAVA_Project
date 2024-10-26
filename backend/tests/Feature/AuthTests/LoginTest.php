<?php

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

uses(RefreshDatabase::class);

//login 1st test
test('login_invalid_phone_test', function () {

    // Create a user
    $user = User::factory()->create([
        'phone_number' => '1234567890', 
        'password' => bcrypt('validpassword'),  // Encrypt password
    ]);

    /// Attempt login with a phone number that doesn't exist
    $response = $this->postJson('/api/auth/login', [
        'phone_number' => '0987654321',  // Non-existent phone
        'password' => 'validpassword',
    ]);

    $response->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);

});

//login 2nd test
test('login_valid_input_test', function () {

    // Create a user
    $user = User::factory()->create([
        'phone_number' => '1234567890', 
        'password' => bcrypt('validpassword'),  // Encrypt password
    ]);

    /// Attempt login with a phone number that doesn't exist
    $response = $this->postJson('/api/auth/login', [
        'phone_number' => '1234567890',  
        'password' => 'validpassword',
    ]);

    $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson([
                'token_type'=>'bearer',
                'expires_in'=>Auth::factory()->getTTl()*60,
             ]);
});

//login 3rd test
test('login_invalid_password_test', function () {

    // Create a user
    $user = User::factory()->create([
        'phone_number' => '1234567890', 
        'password' => bcrypt('validpassword'),  // Encrypt password
    ]);

    /// Attempt login with a phone number that doesn't exist
    $response = $this->postJson('/api/auth/login', [
        'phone_number' => '1234567890',  
        'password' => 'invalidpassword', //wrong password
    ]);

    $response->assertStatus(JsonResponse::HTTP_UNAUTHORIZED);

});

//login 4th test
test('admin_login_valid_input_test', function () {

    // Create a user
    $user = User::factory()->create([
        'phone_number' => '1234567890', 
        'password' => bcrypt('validpassword'),  // Encrypt password
        'usertype'=>'admin',
    ]);

    $order = Order::factory()->create([
        'user_id' => $user->id,
    ]);


    /// Attempt login with a phone number that doesn't exist
    $response = $this->postJson('/api/auth/login', [
        'phone_number' => '1234567890',  
        'password' => 'validpassword',
    ]);

    $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson([
                'success' => true,
                'message'=>'logged in successfully',
                'token_type'=>'bearer',
                'expires_in'=>Auth::factory()->getTTl()*60,
                'orders'=> [[            
                            'university' => $order->university,
                            'major' => $order->major,
                            'type' => $order->type,
                            'description'=> $order->description,
                            'deadline'=>$order->deadline,
                            'user_id' => $user->id,
                ],],
             ]);

    //$response->dump();
});

// login 5th test
test('login_empty_fields_test', function () {

    // Create a user
    $user = User::factory()->create([
        'phone_number' => '1234567890', 
        'password' => bcrypt('validpassword'),  // Encrypt password
    ]);

    /// Attempt login with a phone number that doesn't exist
    $response = $this->postJson('/api/auth/login', [
        'phone_number' => ' ',  
        'password' => ' ',
    ]);

    $response->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);

});

