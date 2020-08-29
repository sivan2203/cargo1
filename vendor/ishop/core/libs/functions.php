<?php

function debug($arr, $die = false){
    echo '<pre>' . print_r($arr, true) . '</pre>';
    if($die) die();
}

function redirect($http = false){
    if ($http){
        $redirect = $http;
    }else{
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    }
    header("Location: $redirect");
    exit;
}

function h($str){
    return $str = htmlspecialchars($str);
}

function bgColorRandom(){
    $baseColors = [
        1 => 'r',
        2 => 'g',
        3 => 'b'
    ];
    $colorMap = [];
    $minValue = 155;
    $maxValue = 200;

    $primaryColorIndex = rand(1, 3);

    $primaryColor = $baseColors[$primaryColorIndex];
    unset($baseColors[$primaryColorIndex]);

    $colorMap[$primaryColor] = 255;

    foreach($baseColors as $baseColor) {
        $colorMap[$baseColor] = rand($minValue, $maxValue);
    }

    krsort($colorMap);

    $color = '';
    foreach($colorMap as $value) {
        $color .= $value;
        if($value !== end($colorMap)) {
            $color .= ',';
        }
    }

    return 'rgb(' . $color . ')';
}