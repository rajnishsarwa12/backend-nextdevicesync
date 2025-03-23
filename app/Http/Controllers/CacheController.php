<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\JsonResponse;

class CacheController extends Controller
{
    /**
     * Clear various Laravel caches.
     *
     * @return JsonResponse
     */
    public function clearCache(): JsonResponse
    {
        try {
            // Clear all caches
            Artisan::call('cache:clear');     // Clear application cache
            Artisan::call('config:clear');    // Clear config cache
            Artisan::call('route:clear');     // Clear route cache
            Artisan::call('view:clear');      // Clear compiled views
            Artisan::call('event:clear');     // Clear event cache
            Artisan::call('optimize:clear');  // Clear all optimizations

            return response()->json([
                'success' => true,
                'message' => 'All caches cleared successfully!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cache clearing failed!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
