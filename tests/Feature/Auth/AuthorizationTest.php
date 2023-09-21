<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     *
     * @test
     *
     * Test with empty data
     * Test with one of the fields missing
     *
     */
    public function itFailsOnMissingCredentials()
    {
        $this->withExceptionHandling();

        $this->postJson('/api/auth/token', [])
            ->assertJsonStructure(['message'])
            ->assertJsonStructure(['errors'])
            ->assertJson([
                "errors" => [
                    "email" => ["The email field is required."],
                    "password" => ["The password field is required."],
                ]
            ])
            ->assertUnprocessable();

        // missing password
        $this->postJson('/api/auth/token', [
            'email' => 'test@mail.com'
        ])
            ->assertJsonStructure(['message'])
            ->assertJsonStructure(['errors'])
            ->assertJson([
                "errors" => [
                    "password" => ["The password field is required."],
                ]
            ])
            ->assertUnprocessable();


        // missing email
        $this->postJson('/api/auth/token', [
            'password' => 'random'
        ])
            ->assertJsonStructure(['message'])
            ->assertJsonStructure(['errors'])
            ->assertJson([
                "errors" => [
                    "email" => ["The email field is required."],
                ]
            ])
            ->assertUnprocessable();
    }

    /**
     *
     * @test
     *
     * Test if the login endpoint denies access from a method different from POST
     *
     */
    public function itFailsOnAccessWithWrongHttpMethod()
    {
        $this->withExceptionHandling();

        $this
            ->getJson('/api/auth/token', [])
            ->assertMethodNotAllowed();


        $this
            ->putJson('/api/auth/token', [])
            ->assertMethodNotAllowed();


        $this
            ->deleteJson('/api/auth/token', [])
            ->assertMethodNotAllowed();
    }
    /**
     *
     * @test
     *
     * Test if the login endpoint fails on usage of wrong credentials
     *
     */
    public function itFailsOnWrongCredentials()
    {
        $this->withExceptionHandling();

        // create an user and send a request to the login route
        $user = User::factory()->create();

        // test with wrong credentials
        $this
            ->postJson('/api/auth/token', [
                'email' => $user->email,
                'password' => $user->password . 'salt' . rand(1, 100),
            ])->assertUnauthorized();
    }



    /**
     *
     * @test
     *
     * Test if the login endpoint passes on usage of correct credentials
     *
     */
    public function itPassesOnWrongCredentials(): void
    {
        $this->withExceptionHandling();

        // create an user and send a request to the login route
        $user = User::factory()->create();

        // test with correct credentials
        $response = $this->postJson('/api/auth/token', [
            'email' => $user->email,
            'password' => $user->password,
        ]);
        $response->assertOk();
        $response->assertJsonStructure(['token']);
    }

    /**
     *
     * @test
     *
     * Test if the login endpoint passes on usage of correct credentials
     *
     */
    public function itGetsInformationOfTheAuthorizedUser()
    {
        $this->withExceptionHandling();

        // create an user and send a request to the login route
        $user = User::factory()->create();

        // test with correct credentials
        $response = $this->postJson('/api/auth/token', [
            'email' => $user->email,
            'password' => $user->password,
        ]);

        $token = $response->json()["token"];

        // Test if we're still able to get to the whoami endpoint
        $response = $this->getJson(
            '/api/auth/whoami',
            [
                'User' => 'Bearer ' . $token,
            ]
        )
            ->assertOK();

        $response
            ->assertJsonStructure(['user'], $response->json())
            ->assertJsonFragment(['email' => $user->email])
            ->assertJsonFragment(['password' => $user->password]);
    }

    /**
     *
     * @test
     * A basic feature test example.
     */
    public function itLogsOut(): void
    {
        $this->withExceptionHandling();

        $user = User::factory()->create();

        // Login
        $response = $this->postJson('/api/auth/token', [
            'email' => $user->email,
            'password' => $user->password,
        ])->assertOk();

        $token = $response->json()["token"];

        // Logout
        $this->postJson('/api/auth/logout', [], [
            'User' => 'Bearer ' . $token,
        ])->assertNoContent();
    }
}
