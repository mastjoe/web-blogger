<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;


    public function test_home_page_can_be_reached()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_guest_can_access_posts_on_home_page()
    {
        $response = $this->get('/');

        $response->assertViewHas('posts', fn($posts) => $posts instanceof LengthAwarePaginator)
            ->assertViewHasAll(['sortParams', 'sortOrders'])
            ->assertStatus(200);
    }

    public function test_guest_can_sort_posts_by_publication_date_in_ascending_order()
    {
        $dates = ["2022-01-01 00:00:00", "2022-01-02 00:00:00", "2022-01-03 00:00:00"];

        array_map(fn($date) => Post::factory()->create(['publication_date' => $date]), $dates);

        $params = http_build_query(["sort"=>"publication_date", "order"=>"asc"]);
        $response = $this->get('/?'.$params);

        $response->assertViewHas('posts', fn($posts) => $posts instanceof LengthAwarePaginator);

        $posts = $response->getOriginalContent()->getData()['posts'];

        $this->assertEquals($posts[0]->publication_date, $dates[0]);
        $this->assertEquals($posts[1]->publication_date, $dates[1]);
        $this->assertEquals($posts[2]->publication_date, $dates[2]);
    }

    public function test_guest_can_sort_posts_by_publication_date_in_descending_order()
    {
        $dates = ["2022-01-01 00:00:00", "2022-01-02 00:00:00", "2022-01-03 00:00:00"];

        array_map(fn($date) => Post::factory()->create(['publication_date' => $date]), $dates);

        $params = http_build_query(["sort"=>"publication_date", "order"=>"desc"]);
        $response = $this->get('/?'.$params);

        $response->assertViewHas('posts', fn($posts) => $posts instanceof LengthAwarePaginator);

        $posts = $response->getOriginalContent()->getData()['posts'];

        $this->assertEquals($posts[0]->publication_date, $dates[2]);
        $this->assertEquals($posts[1]->publication_date, $dates[1]);
        $this->assertEquals($posts[2]->publication_date, $dates[0]);
    }

    public function test_auth_user_can_access_home_page()
    {
        $this->actingAs(User::factory()->create())
            ->get('/')
            ->assertStatus(200)
            ->assertViewHasAll(['posts', 'sortParams', 'sortOrders']);
    }
}
