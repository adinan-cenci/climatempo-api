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
$from       = date('Y-m-d', time() - 60 * 60 * 24 * 5); // 5 days ago


try {
    $history = $climatempo->history($id, $from);
} catch (Exception $e) {
    echo '<b>Error: </b>'.$e->getMessage();
    die();
}

/*-----------------------------*/

require 'resources/header.html';

echo 
"<h2>$history->name / $history->state - $history->country</h2>";


foreach ($history->data as $log) {
    echo 
    "<table class=\"forecast\">
        <caption>
            $log->date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $log->dateBr &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $log->timestamp
        </caption>
        <tbody>
            <tr>
                <th>Precipitation:</th>
                <td>$log->precipitation mm</td>
            </tr>
            <tr>
                <th>Source:</th>
                <td>$log->rainInfoSource</td>
            </tr>
            <tr>
                <th>Min Temperature:</th>
                <td>$log->minTemp °C</td>
            </tr>
            <tr>
                <th>Max Temperature:</th>
                <td>$log->maxTemp °C</td>
            </tr>
            <tr>
                <th>Source:</th>
                <td>$log->tempInfoSource</td>
            </tr>
        </tbody>
    </table>";
}

require 'resources/footer.html';
