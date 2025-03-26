<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Services\ApiResponseService;

class AdminuserController extends Controller
{
   
    public function store(Request $request)
{
    // Validate request
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:adminuser,email',
        'password' => 'required|min:6',
        'phone' => 'nullable|string|max:20|unique:adminuser,phone',
        'profile_image' => 'nullable|string',
        'role' => 'required|in:admin,super_admin,manager',
    ]);

    if ($validator->fails()) {
        return ApiResponseService::error('Validation failed', 422, $validator->errors());
    }

    $inserted = DB::insert("
        INSERT INTO adminuser (name, email, password, phone, profile_image, role, created_at, created_by)
        VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)
    ", [
        $request->name,
        $request->email,
        Hash::make($request->password), // Hash password before inserting
        $request->phone,
        $request->profile_image,
        $request->role,
        auth()->id() ?? null
    ]);

    if ($inserted) {
        return ApiResponseService::success([], 'Admin user created successfully!', 201);
    } else {
        return ApiResponseService::error('Failed to create admin user', 500);
    }
}
}
