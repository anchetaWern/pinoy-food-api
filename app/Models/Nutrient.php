<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nutrient extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id', 
        'name',
    ];


    public function hasChildren()
    {
        return Nutrient::where('parent_id', $this->id)->exists();
    }


    public function children()
    {
        return $this->hasMany(Nutrient::class, 'parent_id', 'id');
    }
}
