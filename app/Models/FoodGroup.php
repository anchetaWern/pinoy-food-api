<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodGroup extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'description',
        'purpose',
    ];
}
