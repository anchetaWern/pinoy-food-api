<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ServingUnit;
use App\Models\CustomServingsCategoryUnit;

class CustomServingsCategory extends Model
{
    use HasFactory;

    public $table = 'custom_servings_categories';

    protected $fillable = [
        'name',
        'slug'
    ];

    public function getRouteKeyName() {
        return 'slug';
    }

    public function servingUnits()
    {
        return $this->belongsToMany(
            ServingUnit::class,  
            CustomServingsCategoryUnit::class,
            'custom_servings_category_id',
            'serving_unit_id'
        );
    }
}
