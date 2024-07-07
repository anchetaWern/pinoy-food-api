<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodDensity extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'density'
    ];

    public $timestamps = false;
}
