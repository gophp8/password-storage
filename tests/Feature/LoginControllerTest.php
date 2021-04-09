<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    public function testSeeLoginPage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee("Master Password");
    }

    public function testAccessStorageWithoutSessionRedirectToLogin() {
        $response = $this->get(route('password.index'));

        $response->assertRedirect("/");
    }
}
