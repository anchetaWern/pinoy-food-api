<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NutriscorePoint;

class NutriscoreCategory extends Model
{
    use HasFactory;

    public $table = 'nutriscore_categories';

    protected $fillable = [
        'name',
        'is_positive',
    ];

    public function points()
    {
        return $this->hasMany(NutriscorePoint::class);
    }
}
