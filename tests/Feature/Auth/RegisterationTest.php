<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_that_registration_page_can_be_reached()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_user_can_register_successfully()
    {
        $response  = $this->post('/register', [
            'name'                  => 'Random User',
            'email'                 => 'random.test-user@gmail.com',
            'password'              => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();
    }
}
