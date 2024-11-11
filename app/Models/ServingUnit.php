<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServingUnit extends Model
{
    use HasFactory;

    public $table = 'serving_units';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'long_name',
        'weight',
        'weight_unit',
        'volume_in_ml',
    ];
}
