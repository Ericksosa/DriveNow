<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inspection extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'inspections';

    protected $fillable = [
        'vehicle_id',
        'customer_id',
        'has_scratches',
        'fuel_level',
        'has_spare_tire',
        'has_car_jack',
        'has_glass_breakage',
        'front_left_tire',
        'front_right_tire',
        'rear_left_tire',
        'rear_right_tire',
        'inspection_date',
        'employee_id',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
