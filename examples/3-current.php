<?php
require 'resources/header.html';
/**
 * # Example of usage
 * 
 * The class ClimaTempo makes the requisitions to the
 * climatempo server, reads the XML and returns an array
 * 
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

/*-----------------------------*/

require '../src/Climatempo.php';
require '../src/Wrapper.php';
require '../src/Forecast.php';
require '../src/Weather.php';

use AdinanCenci\Climatempo\Climatempo;

/*-----------------------------*/

$token      = 'insert-your-token-here';
$climatempo = new Climatempo($token);

$id         = 3477; // São Paulo - SP

$f = $climatempo->current($id);

echo 
"<h2>$f->name / $f->state - $f->country</h2>";


echo 
"<table class=\"forecast\">
    <caption>
        $f->date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $f->dateBr
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
            
                <img src=\"resources/images/$f->icon.png\"/> <br>
                Condition: $f->condition <br>
                Temparature: $f->temperature °C <br>
                Sensation: $f->sensation °C <br>
                Humidity: $f->humidity <br>               
                
            </td>
            <td>
                Wind velocity: $f->windVelocity km/h <br>
                Wind direction: $f->windDirection <br>
                
                Pressure: $f->pressure hPa
            </td>
        </tr>
    </tbody>
</table>";


require 'resources/footer.html';
?>


