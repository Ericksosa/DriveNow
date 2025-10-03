<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CedulaDominicana implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cedula = preg_replace('/\D/', '', $value); // Eliminar todo lo que no sea un número

        if (strlen($cedula) !== 11 || !$this->isValidCedula($cedula)) {
            $fail('La cédula no es válida.');
        }
    }

    /**
     * Verifica si la cédula es válida.
     */
    private function isValidCedula(string $cedula): bool
    {
        $multiplicadores = [1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1];

        $suma = collect(str_split($cedula))
            ->zip($multiplicadores)
            ->map(fn($pair) => $this->sumDigits($pair[0] * $pair[1]))
            ->sum();

        return $suma % 10 === 0;
    }

    /**
     * Suma los dígitos de un número.
     */
    private function sumDigits(int $number): int
    {
        return array_sum(str_split($number));
    }
}