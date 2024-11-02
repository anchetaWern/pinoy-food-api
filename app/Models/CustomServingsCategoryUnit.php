<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomServingsCategoryUnit extends Model
{
    use HasFactory;

    public $table = 'custom_servings_category_units';

    protected $fillable = [
        'custom_servings_category_id',
        'serving_unit_id',
    ];


}
