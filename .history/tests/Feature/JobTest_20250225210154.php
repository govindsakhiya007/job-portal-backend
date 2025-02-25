<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JobTest extends TestCase
{
    /**
     * Employee can
     */
    public function test_an_employer_can_create_a_job()
    {
        $user = User::factory()->create(['role' => 'employer']);

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/jobs', [
            'title' => 'Software Engineer',
            'description' => 'Develop applications',
            'company' => 'Tech Inc',
            'salary' => 60000,
            'location' => 'Remote'
        ]);

        $response->assertStatus(201);
    }
}
