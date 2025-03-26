<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\GpuRequest;
use App\Services\ApiResponseService;
use Exception;

class GpuController extends Controller
{
  
    // ✅ Get All GPUs
    public function index()
    {
        try {
            $gpus = DB::table('gpus')->get();
            return ApiResponseService::success($gpus, 'GPUs fetched successfully');
        } catch (Exception $e) {
            return ApiResponseService::error('Failed to fetch GPUs', 500, $e->getMessage());
        }
    }

    // ✅ Get Single GPU
    public function show($id)
    {
        try {
            $gpu = DB::table('gpus')->where('gpu_id', $id)->first();
            if (!$gpu) {
                return ApiResponseService::error('GPU not found', 404);
            }
            return ApiResponseService::success($gpu, 'GPU fetched successfully');
        } catch (Exception $e) {
            return ApiResponseService::error('Failed to fetch GPU', 500, $e->getMessage());
        }
    }

    // ✅ Create GPU
    public function store(GpuRequest $request)
    {
        try {
            $gpu_id = DB::table('gpus')->insertGetId([
                'company_name' => $request->company_name,
                'gpu_name' => $request->gpu_name,
                'memory_size' => $request->memory_size,
                'core_clock_speed' => $request->core_clock_speed,
                'memory_clock_speed' => $request->memory_clock_speed,
                'boost_clock_speed' => $request->boost_clock_speed,
                'architecture' => $request->architecture,
                'base_speed' => $request->base_speed,
                'create_at' => now(),
            ]);

            return ApiResponseService::success(['gpu_id' => $gpu_id], 'GPU created successfully', 201);
        } catch (Exception $e) {
            return ApiResponseService::error('Failed to create GPU', 500, $e->getMessage());
        }
    }

    // ✅ Update GPU
    public function update(GpuRequest $request, $id)
    {
        try {
            $gpu = DB::table('gpus')->where('gpu_id', $id)->first();
            if (!$gpu) {
                return ApiResponseService::error('GPU not found', 404);
            }

            DB::table('gpus')->where('gpu_id', $id)->update([
                'company_name' => $request->company_name,
                'gpu_name' => $request->gpu_name,
                'memory_size' => $request->memory_size,
                'core_clock_speed' => $request->core_clock_speed,
                'memory_clock_speed' => $request->memory_clock_speed,
                'boost_clock_speed' => $request->boost_clock_speed,
                'architecture' => $request->architecture,
                'base_speed' => $request->base_speed,
                'update_at' => now(),
            ]);

            return ApiResponseService::success(null, 'GPU updated successfully');
        } catch (Exception $e) {
            return ApiResponseService::error('Failed to update GPU', 500, $e->getMessage());
        }
    }

}
