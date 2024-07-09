<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PollingController extends Controller
{
    public function poll(Request $request)
    {
        $updated = Cache::get('updated');
        Cache::put('updated', false);

        return response()->json([
            'message' => 'New data available!',
            'timestamp' => now(),
            'updated' => $updated,
        ]);
        
    }
}
