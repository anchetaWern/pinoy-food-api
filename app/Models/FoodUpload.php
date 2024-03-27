<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodUpload extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_image',
        'title',
        'barcode_image',
        'barcode',
        'nutrition_label_image',
    ];
}
