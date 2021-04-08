<?php

// init
$result = [];

// get json value
$uri = 'https://gist.githubusercontent.com/Loetfi/fe38a350deeebeb6a92526f6762bd719/raw/9899cf13cc58adac0a65de91642f87c63979960d/filter-data.json';
$json = json_decode(file_get_contents($uri), true);

// valiadation
if (isset($json) && is_array($json) && isset($json['data']['response']['billdetails'])) {
    // init into vars
    $details = $json['data']['response']['billdetails'];

    // reindex, remove empty value, loop and return only specifics key
    $result = array_values(array_filter(array_map(function ($ar) {
        // another validation
        if (isset($ar['body'][0]) && ! empty($ar['body'][0])) {

            // changes body string into array with trim
            $denomArr = array_map('trim', explode(':', $ar['body'][0]));

            // return only specifics amount
            if ($denomArr[1] >= 100000) {
                return $denomArr[1];
            }
        }
    }, $details)));
}

print_r($result);

/*
 * RUN : php ArrayFilter.php
 * Then result should be like this
 *
 * Array
 * (
 *   [0] => 100000
 *   [1] => 150000
 *   [2] => 200000
 * )
 */
