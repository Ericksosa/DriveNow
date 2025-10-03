<?php

namespace App\Http\Requests;

use App\Rules\CedulaDominicana;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'entry_date' => 'required|date',
            'gender' => 'required|string|in:Masculino,Femenino',
            'shift' => 'required|string|in:Matutino,Vespertina,Nocturna',
            'id_card_number' => [
                'required',
                'string',
                'max:255',
                'unique:customers,id_card_number,' . $this->route('customer')?->id,
                new CedulaDominicana, // Add the custom validation rule here
            ],
            'commission_percentage' => 'required|integer|min:0|max:100',
        ];
    }
}
