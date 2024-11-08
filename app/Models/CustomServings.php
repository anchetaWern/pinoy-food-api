<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ServingUnit;
use App\Models\CustomServingsUnit;

class CustomServings extends Model
{
    use HasFactory;

    public $table = 'custom_servings';

    protected $fillable = [
        'name',
        'slug'
    ];

    
    public function servingUnits()
    {
        return $this->belongsToMany(
            ServingUnit::class,  
            CustomServingsUnit::class,
            'custom_servings_id',
            'serving_unit_id'
        );
    } 
    
}
