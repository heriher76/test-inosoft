<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Transaction;

class Motorcycle extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'release_year',
        'color',
        'price',
        'engine',
        'suspension',
        'transmission',
        'stock'
    ];

    public function transactions(){
        return $this->hasMany(Transaction::class, 'vehicle_id');
    }
}
