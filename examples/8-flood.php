<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/*-----------------------------*/

require '../vendor/autoload.php';

use AdinanCenci\Climatempo\Climatempo;

/*-----------------------------*/

$token      = 'insert-your-token-here';
$climatempo = new Climatempo($token);
$latitude   = '-26.9917303';
$longitude  = '-48.635989,15';

/*-----------------------------*/

require 'resources/header.html';

try {
    $risk = $climatempo->floodingRisk($latitude, $longitude);
} catch (Exception $e) {
    echo '<b>Error: </b>'.$e->getMessage();
    die();
}


echo 
'<h2>'.$risk->latitude.' '.$risk->longitude.'</h2>';

foreach ($risk->data as $data) {
    echo 
    '<table>
        <tr>
            <th>Value now:</th><td>'.$data->valueNow.'</td></tr>
            <th>Date now:</th><td>'.date('d / M / Y, H:i:s', $data->now).'</td></tr>

            <th>Value next hour:</th><td>'.$data->valueNextHour.'</td></tr>
            <th>Date next hour:</th><td>'.date('d / M / Y, H:i:s', $data->nextHour).'</td></tr>
        </tr>
    </table>';
}

