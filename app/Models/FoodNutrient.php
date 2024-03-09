<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodNutrient extends Model
{
    use HasFactory;

    public $table = 'food_nutrients';

    public $timestamps = false;

    protected $fillable = [
        'food_id',
        'parent_nutrient_id',
        'name',
        'amount',
        'unit',
    ];
}
