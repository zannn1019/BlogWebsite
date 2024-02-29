<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_register(): void
    {
        $response = $this->post("/api/register", [
            "name" => "Name Test",
            "email" => "email.test@gmail.com",
            "password" => "password"
        ]);

        $response->assertStatus(201);
        $user_id = $response->json("data")["user"]["id"];
        User::find($user_id)->delete();
    }

    public function test_login(): void
    {
        $user = User::create([
            "name" => "Name Test",
            "email" => "email.test@gmail.com",
            "password" => Hash::make("password")
        ]);

        $response = $this->postJson("/api/login", [
            "email" => "email.test@gmail.com",
            "password" => "password"
        ])->assertOk();

        $response->assertStatus(200);
        $user->delete();
    }

    public function test_logout(): void
    {
        $user = User::factory()->create()->first();
        $response = $this
            ->actingAs(User::find($user->id), 'sanctum')
            ->postJson('/api/logout', [
                'id' => $user->id
            ]);
        $response->assertStatus(200);
    }
}
