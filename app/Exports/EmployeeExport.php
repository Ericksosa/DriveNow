<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Employee::with('user') // Carga la relación con el usuario
            ->get()
            ->map(function ($employee) {
                return [
                    'employee_id' => $employee->id,
                    'user_id' => $employee->user->id ?? null,
                    'name' => $employee->user->name ?? null,
                    'last_name' => $employee->user->last_name ?? null,
                    'email' => $employee->user->email ?? null,
                    'gender' => $employee->user->gender ?? null,
                    'email_verified_at' => $employee->user->email_verified_at ?? null,
                    'password' => $employee->user->password ?? null,
                    'two_factor_secret' => $employee->user->two_factor_secret ?? null,
                    'two_factor_recovery_codes' => $employee->user->two_factor_recovery_codes ?? null,
                    'two_factor_confirmed_at' => $employee->user->two_factor_confirmed_at ?? null,
                    'remember_token' => $employee->user->remember_token ?? null,
                    'current_team_id' => $employee->user->current_team_id ?? null,
                    'profile_photo_path' => $employee->user->profile_photo_path ?? null,
                    'user_deleted_at' => $employee->user->deleted_at ?? null,
                    'user_created_at' => $employee->user->created_at ?? null,
                    'user_updated_at' => $employee->user->updated_at ?? null,
                    'shift' => $employee->shift,
                    'commission_percentage' => $employee->commission_percentage,
                    'entry_date' => $employee->entry_date,
                    'employee_deleted_at' => $employee->deleted_at,
                    'employee_created_at' => $employee->created_at,
                    'employee_updated_at' => $employee->updated_at,
                ];
            });
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'employee_id',
            'user_id',
            'name',
            'last_name',
            'email',
            'gender',
            'email_verified_at',
            'password',
            'two_factor_secret',
            'two_factor_recovery_codes',
            'two_factor_confirmed_at',
            'remember_token',
            'current_team_id',
            'profile_photo_path',
            'user_deleted_at',
            'user_created_at',
            'user_updated_at',
            'shift',
            'commission_percentage',
            'entry_date',
            'employee_deleted_at',
            'employee_created_at',
            'employee_updated_at',
        ];
    }
}