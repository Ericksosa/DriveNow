<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'chasis_number' => 'required|string|max:255',
            'engine_number' => 'required|string|max:255',
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'vehicle_model_id' => 'required|exists:vehicle_model,id',
            'fuel_type_id' => 'required|exists:fuel_types,id',
            'plate_number' => 'required|string|max:255|unique:vehicles,plate_number,' . optional($this->vehicle)->id,
            'color' => 'required|string|max:255',
            'launching_year' => 'required|date_format:Y',
            'status' => 'required|string|max:255',
            'vehicle_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|in:Lujo,Deportivo,Económico',
            'transmission' => 'required|string|max:255',
            'number_of_doors' => 'required|integer',
            'number_of_seats' => 'required|integer',
            'amount_per_day' => 'required|numeric',
        ];
    }
}
