<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AdditiveFunction;
use App\Models\AdditiveFunctionName;

class Additive extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'alternate_names',
        'INS',
        'purpose',
        'info',
        'health_risks',
    ];

    public function functions()
    {
        return $this->hasManyThrough(
            AdditiveFunctionName::class,      
            AdditiveFunction::class,       
            'additive_id',                
            'id',                       
            'id',                        
            'function_id'      
        );
    }
}
