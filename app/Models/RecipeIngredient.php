<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Food;

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

    public function recipe()
    {
        return $this->belongsTo(Food::class, 'recipe_id', 'id');
    }

    public function ingredient()
    {
        return $this->hasOne(Food::class, 'id', 'ingredient_id');
    }
}
