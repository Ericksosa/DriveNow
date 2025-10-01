<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturnsAndRents extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'returns_and_rents';
    protected $fillable = [
        'employee_id',
        'customer_id',
        'vehicle_id',
        'rent_date',
        'return_date',
        'total_amount',
        'status',
    ];
    protected $casts = [
        'rent_date' => 'datetime',
        'return_date' => 'datetime',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
    public function ratings()
    {
        return $this->hasOne(VehicleRating::class, 'rent_id');
    }
}
