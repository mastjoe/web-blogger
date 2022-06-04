<?php

namespace Tests\Feature;

use App\Models\Post;
use Tests\TestCase;
use Database\Seeders\AdminSeeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PullFeedCommandTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_pull_feeds_from_external_source_and_save_for_system_admin()
    {
        // $response = $this->get('/');
        $this->seed(AdminSeeder::class);

        $count = mt_rand(1, 3);

        // mock response
        Http::fake(function() use($count) {
            return Http::response([
                "data" => array_fill(0, $count , $this->responseDefinition())
            ]);
        });

        $this->artisan('pull:feed')->assertSuccessful();

        $this->assertDatabaseCount('posts', $count);
    }

    protected function responseDefinition() :array
    {
        return [
            'title'            => $this->faker->words(5, true),
            'description'      => $this->faker->realText(300),
            'publication_date' => now()->addDays(mt_rand(-10, 10))->toDateTimeString()
        ];
    }
}
