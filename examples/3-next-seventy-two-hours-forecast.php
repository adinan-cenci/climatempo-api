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
    $forecast = $climatempo->seventyTwoHours($id);
} catch (Exception $e) {
    echo '<b>Error: </b>'.$e->getMessage();
    die();
}

/*-----------------------------*/

require 'resources/header.html';

echo 
"<h2>$forecast->name / $forecast->state - $forecast->country</h2>";

foreach ($forecast->data as $day) {
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
