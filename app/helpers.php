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

function normalizeNutrientValue($nutrient_value, $total_weight) {
    if ($total_weight != 100) {
        $res = ($nutrient_value / $total_weight) * 100;
        return round($res, 2);
    }
    return $nutrient_value;
}