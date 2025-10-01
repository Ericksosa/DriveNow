<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Vehicle extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    public $table = 'vehicles';

    public $fillable = [
        'name',
        'description',
        'chasis_number',
        'engine_number',
        'plate_number',
        'launching_year',
        'category',
        'number_of_doors',
        'number_of_seats',
        'transmission',
        'color',
        'vehicle_type_id',
        'brand_id',
        'fuel_type_id',
        'vehicle_model_id',
        'amount_per_day',
        'status'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('vehicle_images');
    }


    public function fuelType()
    {
        return $this->belongsTo(FuelType::class);
    }

    public function vehicleModel()
    {
        return $this->belongsTo(VehicleModel::class);
    }

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    public function returnsAndRents()
    {
        return $this->hasMany(ReturnsAndRents::class);
    }
    public function ratings()
    {
        return $this->hasMany(VehicleRating::class, 'vehicle_id');
    }
}
