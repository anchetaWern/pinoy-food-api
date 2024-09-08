<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Additive extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'INS',
        'purpose',
        'info',
        'health_risks',
    ];
}
