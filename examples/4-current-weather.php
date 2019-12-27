<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/*-----------------------------*/

require '../vendor/autoload.php';

use AdinanCenci\Climatempo\Climatempo;

/*-----------------------------*/

$token      = 'insert-your-token-here';
$climatempo = new Climatempo($token);

$id         = 3477; // São Paulo - SP

try {
    $weather = $climatempo->current($id);
} catch (Exception $e) {
    echo '<b>Error: </b>'.$e->getMessage();
    die();
}

/*-----------------------------*/

require 'resources/header.html';

echo 
"<h2>$weather->name / $weather->state - $weather->country</h2>";

echo 
"<table class=\"forecast\">
    <caption>
        $weather->date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $weather->dateBr
    </caption>
    <thead>
        <tr>
            <th>Temperature</th>
            <th>Wind</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
            
                <img src=\"resources/images/$weather->icon.png\"/> <br>
                Condition: $weather->condition <br>
                Temparature: $weather->temperature °C <br>
                Sensation: $weather->sensation °C <br>
                Humidity: $weather->humidity <br>               
                
            </td>
            <td>
                Wind velocity: $weather->windVelocity km/h <br>
                Wind direction: $weather->windDirection <br>
                
                Pressure: $weather->pressure hPa
            </td>
        </tr>
    </tbody>
</table>";


require 'resources/footer.html';
