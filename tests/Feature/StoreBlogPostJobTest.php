<?php

namespace Tests\Feature;

use App\Jobs\StoreBlogPostJob;
use App\Models\Post;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreBlogPostJobTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_store_blog_post_job()
    {
        $user = User::factory()->create();

        $data = [
            'title'            => $this->faker->words(10, true),
            'description'      => $this->faker->realText(300),
            'publication_date' => now()->toDateTimeString(),
            'user_id'          => $user->id,
        ];

        // dispatch job
        (new StoreBlogPostJob($data))->handle();

        $this->assertDatabaseCount('posts', 1);
    }
}
