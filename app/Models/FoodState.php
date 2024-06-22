<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodState extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'parent_id'];

    public $timestamps = false;
}
