<?php
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;

uses(RefreshDatabase::class);

test('register', function () {
    
    $response = $this->postJson('/routes/api/auth/register', [
        'name' => 'J3fr',
        'lastname' => 'ma7fud',
        'phone' => '1234567890',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertStatus(JsonResponse::HTTP_CREATED)
             ->assertJson([
                 'message' => 'registered successfully',
                 'user' => [
                     'name' => 'John',
                     'lastname' => 'Doe',
                     'phone' => '1234567890',
                 ],
             ]);

    $this->assertDatabaseHas('users', [
        'phone' => '1234567890',
    ]);
    //$response->assertStatus(201);
});
