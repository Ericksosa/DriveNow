<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'employees';

    protected $fillable = [
        'id_card_number',
        'user_id',
        'shift',
        'commission_percentage',
        'entry_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function returnsAndRents()
    {
        return $this->hasMany(ReturnsAndRents::class, 'employee_id');
    }
    public function inspections()
    {
        return $this->hasMany(Inspection::class, 'employee_id');
    }
}
