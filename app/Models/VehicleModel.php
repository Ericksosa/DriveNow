<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'vehicle_model';

    protected $fillable = [
        'name',
        'brand_id',
        'description',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
