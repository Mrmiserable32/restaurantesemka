<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use PDOException;
use Tests\TestCase;

class DatabaseCheckTest extends TestCase
{
    public function test_it_reports_a_healthy_connection(): void
    {
        $this->getJson('/api/cekdatabase')
            ->assertOk()
            ->assertJson(['message' => 'Database connection successful']);
    }

    public function test_it_reports_a_failing_connection_without_leaking_details(): void
    {
        config(['app.debug' => false]);

        DB::shouldReceive('connection')->once()->andThrow(new PDOException('could not find driver'));

        $response = $this->getJson('/api/cekdatabase');

        $response->assertStatus(503)
            ->assertJson(['message' => 'Database connection failed']);

        $this->assertArrayNotHasKey('error', $response->json());
    }
}
