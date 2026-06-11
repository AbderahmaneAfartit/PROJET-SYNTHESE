<?php

namespace Tests\Feature;

use App\Models\ClientJob;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ApiContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_api_health_status(): void
    {
        $this->getJson('/api/health')
            ->assertOk()
            ->assertJson([
                'status' => 'ok',
            ]);
    }

    public function test_it_accepts_valid_contact_messages(): void
    {
        Log::shouldReceive('info')->once();

        $this->postJson('/api/contact', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'subject' => 'suggestion',
            'message' => 'This is a valid contact message for the API.',
        ])->assertCreated()
            ->assertJson([
                'message' => 'Message recu avec succes.',
            ]);
    }

    public function test_it_validates_contact_messages(): void
    {
        $this->postJson('/api/contact', [
            'name' => '',
            'email' => 'bad-email',
            'subject' => '',
            'message' => 'short',
        ])->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'email', 'subject', 'message']);
    }

    public function test_signup_creates_client_user_without_jobs(): void
    {
        $this->postJson('/api/signup', [
            'name' => 'Client Test',
            'email' => 'client-test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'travailleur' => false,
        ])->assertCreated()
            ->assertJsonPath('user.role', 'client');

        $this->assertDatabaseHas('users', [
            'email' => 'client-test@example.com',
            'role' => 'client',
        ]);
        $this->assertDatabaseCount('client_jobs', 0);
    }

    public function test_signup_creates_manjobs_user_with_jobs(): void
    {
        $this->postJson('/api/signup', [
            'name' => 'Worker Test',
            'email' => 'worker-test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'travailleur' => true,
            'jobs' => ['React developer', 'Laravel API'],
        ])->assertCreated()
            ->assertJsonPath('user.role', 'manjob')
            ->assertJsonCount(2, 'user.client_jobs');

        $this->assertDatabaseHas('client_jobs', [
            'title' => 'React developer',
        ]);
    }

    public function test_login_returns_user_token_and_jobs(): void
    {
        $user = User::factory()->create([
            'email' => 'login@example.com',
            'password' => Hash::make('password123'),
            'role' => 'manjob',
        ]);
        ClientJob::factory()->create([
            'user_id' => $user->id,
            'title' => 'WordPress maintenance',
        ]);

        $this->postJson('/api/login', [
            'email' => 'login@example.com',
            'password' => 'password123',
        ])->assertOk()
            ->assertJsonPath('user.role', 'manjob')
            ->assertJsonCount(1, 'user.client_jobs');
    }

    public function test_seeders_create_every_role(): void
    {
        $this->seed();

        foreach (['admin', 'client', 'manjob'] as $role) {
            $this->assertDatabaseHas('users', ['role' => $role]);
        }

        $this->assertGreaterThanOrEqual(2, ClientJob::count());
    }

    public function test_it_lists_client_jobs_for_signup_options(): void
    {
        $user = User::factory()->create(['role' => 'manjob']);
        ClientJob::factory()->create([
            'user_id' => $user->id,
            'title' => 'Node.js consultant',
        ]);

        $this->getJson('/api/client-jobs')
            ->assertOk()
            ->assertJsonPath('jobs.0.title', 'Node.js consultant');
    }
}
