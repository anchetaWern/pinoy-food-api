<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'foods';

    protected $fillable = [
        'description', 
        'calories',
        'calories_unit',
        'serving_size',
        'serving_size_unit',
        'servings_per_container',
        'nutrients',
    ];

    protected $casts = [
        'nutrients' => 'array',
    ];
}
