<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GpuRequest extends FormRequest
{
    public function rules()
    {
        return [
            'gpu_company_id' => 'required|integer|exists:gpu_companies,gpu_company_id',
            'gpu_name' => 'required|string|max:255',
            'memory_size' => 'nullable|string|max:50',
            'core_clock_speed' => 'nullable|string|max:50',
            'memory_clock_speed' => 'nullable|string|max:50',
            'boost_clock_speed' => 'nullable|string|max:50',
            'architecture' => 'nullable|string|max:255',
            'base_speed' => 'nullable|string|max:50',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
