<?php

namespace Tests\Feature\Admin\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Admin\TestCase;
use App\Models\User;

class UserConfirmationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Check if a user with permission can confirm user verification
     *
     * @return void
     */
    public function test_check_a_user_with_permission_can_confirm_user_verification()
    {
        $this->loginAsAdmin();

        $user = User::factory()->unconfirmed()->create();

        $response = $this->post("/a/users/{$user->id}/confirm/email-verification");

        $database = $this->app->make('db');

        $connection = $database->getDefaultConnection();

        $count = $database->connection($connection)
            ->table('users')
            ->where('id', '=', $user->id)
            ->whereNotNull('email_verified_at')
            ->count();

        $this->assertGreaterThan(0, $count);

        $response->assertSessionHas(['flash_success' => 'The user was successfully confirmed.']);
    }

    /**
     * Check if a user without permission cannot confirm user verification
     *
     * @return void
     */
    public function test_check_if_a_user_without_permission_cannot_confirm_user_verification()
    {
        $this->loginAsUser();

        $user = User::factory()->unconfirmed()->create();

        $response = $this->post("/a/users/{$user->id}/confirm/email-verification");

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email_verified_at' => null
        ]);

        $response->assertStatus(403);
    }

    /**
     * Check if a user without permission cannot confirm user verification
     *
     * @return void
     */
    public function test_check_a_user_with_permission_can_unconfirm_user_verification()
    {
        $this->loginAsAdmin();

        $user = User::factory()->create();

        $response = $this->post("/a/users/{$user->id}/unconfirm/email-verification");

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email_verified_at' => null
        ]);

        $response->assertSessionHas(['flash_success' => 'The user was successfully disconfirmed.']);
    }

    /**
     * Check if a user without permission cannot unconfirm user verification
     *
     * @return void
     */
    public function test_check_if_a_user_without_permission_cannot_unconfirm_user_verification()
    {
        $this->loginAsUser();

        $email_verified_at = now();

        $user = User::factory()->create([
            'email_verified_at' => $email_verified_at
        ]);

        $response = $this->post("/a/users/{$user->id}/unconfirm/email-verification");

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email_verified_at' => $email_verified_at
        ]);

        $response->assertStatus(403);
    }

    /**
     * Check user with permission resend email verification verified user
     *
     * @return void
     */
    public function test_check_user_with_permission_resend_email_verification_verified_user()
    {
        $this->loginAsAdmin();

        $user = User::factory()->unconfirmed()->create();

        $response = $this->post("/a/users/{$user->id}/resend/email-verification");

        // TODO: Check if notification send

        $response->assertSessionHas(['flash_success' => 'Email verification was sent successfully.']);
    }

    /**
     * Check user without permission resend email verification verified user
     *
     * @return void
     */
    public function test_check_user_without_permission_resend_email_verification_verified_user()
    {
        $this->loginAsUser();

        $user = User::factory()->unconfirmed()->create();

        $response = $this->post("/a/users/{$user->id}/resend/email-verification");

        $response->assertStatus(403);
    }
}
