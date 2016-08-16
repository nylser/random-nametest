<?php


function get_value($name){
    $name = trim($name);
    $number = 0;
    $stelle = strlen($name)+1;
    foreach (str_split($name) as $char){
        $number = $number + ord($char) * $stelle;
        $stelle = $stelle -1;
    }
    return $number;
}

# Does ignore length differences
function get_match_value($male, $female){
    $value_male = get_value($male);
    $value_male = $value_male + sin($value_male) * 6;
    $value_female = get_value($female);
    $value_female = $value_female + cos($value_female) * 6;
    if ($value_male > $value_female){
        $v = $value_female / $value_male;
    } else {
        $v = $value_male / $value_female;
    }
    return $v * 150;
}

$female_chars = array('a', 'A', 'i', 'I');
$male_chars = array('o', 'O', 'u', 'U');

function get_valdict($name){
    $chars = array();
    foreach(str_split($name) as $char){
        if(isset($chars[$char])){
            $chars[$char] = $chars[$char] + 1;
        } else {
            $chars[$char] = 1;
        }
    }
    return $chars;
}

function get_valdict_value($valdict, $double_value, $half_value){
    $multiplier = 100;
    $value = 0;
    foreach($valdict as $char => $amount){
        if (in_array($char, $double_value)){
            $value = $value + ($amount * $multiplier) * 2;
        } else if (in_array($char, $half_value)){
            $value = $value + ($amount * $multiplier) / 2;
        } else {
            $value = $value + ($amount * $multiplier);
        }
        $multiplier = $multiplier - $amount;
    }
    return $value;
}

# Takes length difference into account -> actual chars are more significant; Although they all have a value close to 100 (see multiplier in get_valdict_value())
function get_valdict_match($male, $female){
    $dict_male = get_valdict($male);
    $dict_female = get_valdict($female);
    $value_male = get_valdict_value($dict_male, $male_chars, $female_chars);
    $value_female = get_valdict_value($dict_female, $female_chars, $male_chars);
    if (strlen($male) > strlen($female)){
        $value_male = $value_male - ($value_male * (1 - (strlen($female)) / strlen($male)));
    } elseif (strlen($female) > strlen($male)){
        $value_female = $value_female - ($value_female * (1 - (strlen($male)) / strlen($female)));
    }
    if ($value_male > $value_female){
        $v = $value_female / $value_male;
    } else {
        $v = $value_male / $value_female;
    }
    return $v * 150;
}

?>
