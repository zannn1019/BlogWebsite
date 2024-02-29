<?php

namespace Tests\Feature;

use App\Http\Resources\CategoryResource;
use Tests\TestCase;
use App\Models\User;
use App\Models\Categories;
use Laravel\Sanctum\Sanctum;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_all_categories(): void
    {
        $response = $this->get('/api/category');
        $response->assertStatus(200);
    }

    public function test_get_single_category(): void
    {
        $category = Categories::factory(1)->create()->first();
        $response = $this->get('/api/category/' . $category->id);
        $response->assertStatus(200);
        $category->delete();
    }

    public function test_create_a_category(): void
    {
        $user = User::factory(1)->create()->first();
        $response = $this
            ->actingAs(User::find($user->id), 'sanctum')
            ->postJson('/api/category', [
                'category' => "Test Category"
            ])
            ->assertCreated();
        $response->assertStatus(201);
        $category_id = $response->json('data')['id'];
        Categories::find($category_id)->delete();
        $user->delete();
    }

    public function test_update_a_category(): void
    {
        $category = Categories::factory(1)->create()->first();
        $user = User::factory(1)->create()->first();
        $response = $this
            ->actingAs(User::find($user->id), 'sanctum')
            ->patchJson('/api/category/' . $category->id, [
                'category' => "Test Category 2"
            ])
            ->assertOk();
        $response->assertStatus(200);
        $user->delete();
        $category->delete();
    }

    public function test_delete_a_category(): void
    {
        $category = Categories::factory(1)->create()->first();
        $user = User::factory(1)->create()->first();
        $response = $this
            ->actingAs(User::find($user->id), 'sanctum')
            ->deleteJson('/api/category/' . $category->id)
            ->assertOk();
        $response->assertStatus(200);
        $user->delete();
        $category->delete();
    }
}
