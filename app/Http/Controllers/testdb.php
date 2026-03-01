<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Testdb extends Controller
{

    public function check()
    {
        try {
            DB::connection()->getPdo();
            return response()->json(['message' => 'Database connection successful']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Database connection failed', 'error' => $e->getMessage()], 500);
        }
    }
}
