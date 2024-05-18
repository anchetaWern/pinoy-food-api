<?php 

function nutrientData($food_nutrients, $nutrient_to_search)
{
    $nutrient = $food_nutrients->firstWhere('name', strtolower($nutrient_to_search));
    if ($nutrient) {
        return [
            'id' => $nutrient['id'],
            'value' => $nutrient['amount'] . $nutrient['unit'],
        ];
    }
    return [
        'value' => ''
    ];
}