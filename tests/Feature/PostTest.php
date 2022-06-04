<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_unique_slug_formation_for_posts_with_same_title()
    {
        $title = $this->faker->words(5, true);

        $posts = Post::factory()->count(3)->create(['title' => $title]);

        $this->assertEquals($posts->get(0)->slug, Str::slug($title));
        $this->assertEquals($posts->get(1)->slug, Str::slug($title."-1"));
        $this->assertEquals($posts->get(2)->slug, Str::slug($title."-2"));
    }

    public function test_guest_can_access_post_details()
    {
        $post = Post::factory()->create();

        $response = $this->get('/posts/'.$post->slug);

        $response->assertStatus(200);
    }

   
    public function test_guest_cannot_view_their_created_post_but_redirected_to_login()
    {
        $response = $this->get('/posts');

        $response->assertStatus(302)
            ->assertRedirect('/login');
    }

    public function test_auth_user_can_view_created_posts()
    { 
        $this->actingAs(User::factory()->create(), 'web')
            ->get('/posts')
            ->assertStatus(200)
            ->assertViewHas('posts', fn($posts) => $posts instanceof LengthAwarePaginator)
            ->assertViewHasAll(['sortParams', 'sortOrders'])
            ->assertViewIs('blogs.posts.index');
    }

    public function test_auth_user_can_view_post_details()
    {
        $post = Post::factory()->create();

        $this->actingAs(User::factory()->create(), 'web')
            ->get('posts/'.$post->slug)
            ->assertStatus(200);
    }

    public function test_guest_user_cannot_access_create_post_page()
    {
        $this->get('posts/create')
            ->assertRedirect('/login');
    }

    public function test_auth_user_can_access_create_post_page()
    {
        $this->actingAs(User::factory()->create(), 'web')
            ->get('posts/create')
            ->assertStatus(200)
            ->assertViewIs('blogs.posts.create');
    }

    public function test_user_can_create_a_post()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->post('/posts', [
                'title'            => $this->faker->word(5, true),
                'description'      => $this->faker->realText(300),
                'publication_date' => now()->toDateTimeString(),
            ]);
            
        $response->assertSessionHas('success')
            ->assertSessionDoesntHaveErrors()
            ->assertRedirect('/posts');

        $this->assertDatabaseCount('posts', 1);
    }

}
