<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class Testdb extends Controller
{
    public function check(): JsonResponse
    {
        try {
            DB::connection()->getPdo();
        } catch (Throwable $e) {
            Log::error('Database connection check failed', [
                'connection' => config('database.default'),
                'exception' => $e,
            ]);

            $payload = ['message' => 'Database connection failed'];

            if (config('app.debug')) {
                $payload['error'] = $e->getMessage();
            }

            return response()->json($payload, 503);
        }

        return response()->json(['message' => 'Database connection successful']);
    }
}
