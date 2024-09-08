<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditiveFunction extends Model
{
    use HasFactory;

    protected $fillable = [
        'additive_id',
        'function_id',
    ];

    public $timestamps = false;
}
