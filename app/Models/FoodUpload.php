<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodUpload extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title_image',
        'title',
        'barcode_image',
        'barcode',
        'nutrition_label_image',
        'ingredients_image',
    ];
}
