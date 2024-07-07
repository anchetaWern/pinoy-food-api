<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodGroupConversionUnit extends Model
{
    use HasFactory;

    public $timstamps = false;

    protected $fillable = [
        'food_group_id',
        'conversion_unit_id',
    ];
}
