<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\NutriscoreCategory;

class NutriscorePoint extends Model
{
    use HasFactory;

    public $table = 'nutriscore_points';

    protected $fillable = [
        'nutriscore_category_id',
        'food_type',
        'min_value',
        'max_value',
        'points',
    ];

    public function category()
    {
        return $this->belongsTo(NutriscoreCategory::class);
    }
}
