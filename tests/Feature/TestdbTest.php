<?php

namespace Tests\Feature;

use App\Http\Controllers\Testdb;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TestdbTest extends TestCase
{
    public function test_check_returns_success_message_when_connection_works(): void
    {
        $response = $this->getJson('/api/cekdatabase');

        $response->assertOk();
        $response->assertExactJson(['message' => 'Database connection successful']);
    }

    public function test_check_returns_error_payload_when_connection_fails(): void
    {
        DB::shouldReceive('connection')
            ->once()
            ->andThrow(new \RuntimeException('could not connect'));

        $response = (new Testdb)->check();

        $this->assertSame(500, $response->getStatusCode());
        $this->assertSame([
            'message' => 'Database connection failed',
            'error' => 'could not connect',
        ], $response->getData(true));
    }
}
