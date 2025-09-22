<?php

namespace App\Actions\Fortify;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        // Validar los datos de entrada
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'in:Masculino,Femenino'],
            'phone_number' => ['required', 'string', 'max:20'],
            'id_card_number' => ['required', 'string', 'max:20'],
            'credit_card_number' => ['required', 'string', 'max:20'],
            'person_type' => ['required', 'string', 'in:fisica,juridica'], // Asegúrate de que sea 'fisica' o 'juridica'
            'driver_license_number' => ['required', 'string', 'max:50'],
            'driver_license_expiration_date' => ['required', 'date'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // Crear el usuario y el cliente dentro de una transacción
        return DB::transaction(function () use ($input) {
            // Crear el usuario
            $user = User::create([
                'name' => $input['name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
                'gender' => $input['gender'],
                'password' => Hash::make($input['password']),
            ]);
            $user->assignRole('Cliente');
            // Crear el cliente asociado al usuario
            Customer::create([
                'user_id' => $user->id,
                'phone_number' => $input['phone_number'],
                'id_card_number' => $input['id_card_number'],
                'credit_card_number' => $input['credit_card_number'],
                'credit_limit' => '3500', // Valor predeterminado
                'person_type' => $input['person_type'],
                'driver_license_number' => $input['driver_license_number'],
                'driver_license_expiration_date' => $input['driver_license_expiration_date'],
            ]);

            // Devolver solo el usuario para que Laravel pueda autenticarlo
            return $user;
        });
    }
}