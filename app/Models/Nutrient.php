<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Food;

class Nutrient extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id', 
        'name',
        'placeholder_text',
    ];


    public function hasChildren()
    {
        return Nutrient::where('parent_id', $this->id)->exists();
    }


    public function children()
    {
        return $this->hasMany(Nutrient::class, 'parent_id', 'id');
    }


    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }
}
