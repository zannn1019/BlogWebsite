<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_get_all_post(): void
    {
        $response = $this->get('/api/post');
        $response->assertStatus(200);
    }

    public function test_get_single_post(): void
    {
        $user = User::factory(1)->create()->first();
        $category = Categories::factory(1)->create()->first();
        $post = Post::factory(1)->create()->first();
        $response = $this->get('/api/post/' . $post->id);

        $response->assertStatus(200);
        $post->delete();
        $category->delete();
        $user->delete();
    }

    public function test_create_a_post(): void
    {
        $user = User::factory(1)->create()->first();
        $category = Categories::factory(1)->create()->first();
        $title = fake('en')->unique()->paragraph(1);
        $imageFile = UploadedFile::fake()->image('thumbnail.jpg');

        $response = $this
            ->actingAs(User::find($user->id), 'sanctum')
            ->postJson('/api/post', [
                'user_id' => $user->id,
                'title' => $title,
                'content' => fake('en')->paragraph(random_int(5, 20)),
                'slug' => Str::slug($title),
                'thumbnail' => $imageFile,
                'category_id' => $category->id
            ]);
        $response->assertStatus(201);

        $post_id = $response->json('data')['id'];
        $post = Post::find($post_id)->delete();
        $user->delete();
        $category->delete();
    }

    public function test_update_a_post(): void
    {
        $user = User::factory(1)->create()->first();
        $category = Categories::factory(1)->create()->first();
        $post = Post::factory(1)->create()->first();

        $title = fake('en')->unique()->paragraph(1);

        $response = $this
            ->actingAs(User::find($user->id), 'sanctum')
            ->patchJson('/api/post/' . $post->id, [
                'title' => $title,
                'content' => fake('en')->paragraph(random_int(5, 20)),
                'slug' => Str::slug($title),
            ])
            ->assertOk();
        $response->assertStatus(200);
        $post->delete();
        $category->delete();
        $user->delete();
    }

    public function test_delete_a_category(): void
    {
        $user = User::factory(1)->create()->first();
        $category = Categories::factory(1)->create()->first();
        $post = Post::factory(1)->create()->first();

        $response = $this
            ->actingAs(User::find($user->id), 'sanctum')
            ->deleteJson('/api/post/' . $post->id)
            ->assertOk();
        $response->assertStatus(200);

        $post->delete();
        $category->delete();
        $user->delete();
    }
}
