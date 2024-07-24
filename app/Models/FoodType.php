<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'nova_class',
        'parent_id'
    ];

    public $timestamps = false;
}
