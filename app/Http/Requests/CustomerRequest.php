<?php

namespace App\Http\Requests;

use App\Rules\CedulaDominicana;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required|string|max:255',
            'gender' => 'required|string|in:Masculino,Femenino',
            'id_card_number' => [
                'required',
                'string',
                'max:255',
                'unique:customers,id_card_number,' . $this->route('customer')?->id,
                new CedulaDominicana, // Add the custom validation rule here
            ],
            'driver_license_number' => 'required|string|max:255|unique:customers,driver_license_number,' . $this->route('customer')?->id,
            'driver_license_expiration_date' => 'required|date|after_or_equal:today',
            'credit_card_number' => 'required|string|max:255|unique:customers,credit_card_number,' . $this->route('customer')?->id,
            'credit_limit' => 'nullable|numeric|min:0',
            'person_type' => 'required|string|in:Física,Jurídica',
        ];
    }
}
