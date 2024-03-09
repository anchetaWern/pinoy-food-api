<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodBarcode extends Model
{
    use HasFactory;

    public $table = 'food_barcodes';

    protected $fillable = [
        'food_id',
        'barcode',
    ];
}
