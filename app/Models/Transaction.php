<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Car;
use App\Models\Motorcycle;

class Transaction extends Model
{
    protected $fillable = [
        'purchase_date', 'buyer_name', 'unit', 'vehicle_id', 'type'
    ];

    use HasFactory;

    public function car(){
        return $this->belongsTo(Car::class);
    }

    public function motorcycle(){
        return $this->belongsTo(Motorcycle::class);
    }
}
