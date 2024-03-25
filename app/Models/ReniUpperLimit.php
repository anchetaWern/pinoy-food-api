<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReniUpperLimit extends Model
{
    use HasFactory;

    public $table = 'reni_upper_limits';

    protected $fillable = [
        'age_from', 'age_to', 'age_type',

        'vitamin_a',
        'vitamin_d',
        'vitamin_e',
        'vitamin_niacin',
        'vitamin_pyridoxine',
        'folate',
        'vitamin_c',
        'iron',
        'zinc',
        'selenium',
        'iodine',
        'calcium',
        'magnesium',
        'phosphorus',
        'fluoride',
    ];

    protected $visible = [
        'age_from', 'age_to', 'age_type',

        'vitamin_a',
        'vitamin_d',
        'vitamin_e',
        'vitamin_niacin',
        'vitamin_pyridoxine',
        'folate',
        'vitamin_c',
        'iron',
        'zinc',
        'selenium',
        'iodine',
        'calcium',
        'magnesium',
        'phosphorus',
        'fluoride',
    ];
}
