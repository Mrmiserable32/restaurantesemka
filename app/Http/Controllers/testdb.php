<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Testdb extends Controller
{

    public function check()
    {
        try {
            DB::connection()->getPdo();
            return response()->json(['message' => 'Database connection successful']);
        } catch (\Exception $e) {
            Log::error('Database connection check failed', ['exception' => $e]);
            return response()->json(['message' => 'Database connection failed'], 500);
        }
    }
}
