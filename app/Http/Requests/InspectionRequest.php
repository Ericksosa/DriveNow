<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InspectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'inspection_date' => 'required|date',
            'has_scratches' => 'required|boolean',
            'fuel_level' => 'required|string|in:1/4,1/2,3/4,lleno',
            'has_spare_tire' => 'required|boolean',
            'has_car_jack' => 'required|boolean',
            'has_glass_breakage' => 'required|boolean',
            'front_left_tire' => 'required|string|in:Buena,Regular,Mala',
            'front_right_tire' => 'required|string|in:Buena,Regular,Mala',
            'rear_left_tire' => 'required|string|in:Buena,Regular,Mala',
            'rear_right_tire' => 'required|string|in:Buena,Regular,Mala',
        ];
    }
}
