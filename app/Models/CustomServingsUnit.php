<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomServingsUnit extends Model
{
    use HasFactory;

    public $table = 'custom_servings_units';

    public $timestamps = false;

    protected $fillable = [
        'custom_servings_id',
        'serving_unit_id',
    ];


}
