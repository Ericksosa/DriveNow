<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'customers';

    protected $fillable = [
        'id_card_number',
        'user_id',
        'credit_card_number',
        'credit_limit',
        'person_type',
        'driver_license_number',
        'driver_license_expiration_date',
        'phone_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function returnsAndRents()
    {
        return $this->hasMany(ReturnsAndRents::class, 'customer_id');
    }
    public function inspections()
    {
        return $this->hasMany(Inspection::class, 'customer_id');
    }
    public function ratings()
    {
        return $this->hasMany(VehicleRating::class, 'customer_id');
    }
}
