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
require '../src/SeventyTwoHours.php';

use AdinanCenci\Climatempo\Climatempo;

/*-----------------------------*/

$token      = 'insert-your-token-here';
$climatempo = new Climatempo($token);

$id         = 3477; // São Paulo - SP

$f = $climatempo->seventyTwoHours($id);

echo 
"<h2>$f->name / $f->state - $f->country</h2>";


foreach ($f->data as $day) {
    echo 
    "<table class=\"forecast\">
        <caption>
            $day->date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $day->dateBr
        </caption>
        <thead>
            <tr>
                <th>Temperature</th>
                <th>Rain</th>
                <th>Wind</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    $day->temperature °C
                </td>
                <td>
                    ".($day->precipitation ? 'Prec.: '.$day->precipitation.'mm' : '')."
                </td>
                <td>
                    Velocity: $day->windVelocity km/h <br>
                    Gust: $day->gustVelocity km/h <br>
                    Direction: $day->windDirectionDegree ° ( $day->windDirection ) <br>
                </td>
            </tr>
        </tbody>
    </table>";
}


require 'resources/footer.html';
?>


