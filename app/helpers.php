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

function getValueAndUnit($text)
{
    preg_match('/^([\d.]+)(\D+)/', $text, $matches);

    if (!empty($matches)) {

        return [
            'value' => $matches[1],
            'unit' => $matches[2],
        ];
    }

    return [
        'value' => 1,
        'unit' => 'g',
    ];
}

function formatPortion($amount, $modifier) {
    // Extract numeric value from modifier using regex
    if (preg_match('/\((.*?)\)/', $modifier, $matches)) {
        return [
            $amount,
            str_replace(' ', '', $matches[1])
        ]; // Remove spaces (e.g., "3 oz" -> "3oz")
    }
    
    // Fallback if no parentheses found
    return [
       $amount,
       $modifier, 
    ];
}