<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeIngredient extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'recipe_id',
        'ingredient_id',
        'serving_size',
        'serving_size_unit',
    ];
}
