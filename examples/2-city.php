<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'resources/header.html';

/*-----------------------------*/

require '../src/Climatempo.php';
require '../src/Search.php';
require '../src/City.php';

use AdinanCenci\Climatempo\Search;

/*-----------------------------*/

$search = new Search('belo horizonte');
$bh     = $search->find()[0];

/*-----------------------------*/

echo "
<p>
    Here is the forecast for the citiy of $bh->name - $bh->state
</p>";

if (! $bh->forecast) {
    echo '<h2>Error!</h2>';
    print_r($bh->errors);
}

?>

<table>
    <tr>
        <th>Date</th>
        <th title="Lower temperature">Low</th>
        <th title="Higher temperature">Hight</th>
        <th title="Probability of precipitation">Pop</th>
        <th title="Precipitation">MM</th>
        <th>Icon</th>
        <th>Phrase</th>
    </tr>
    <?php

    foreach ($bh->forecast as $day) {
        echo "
        <tr>
            <td> ". date('Y-m-d', $day['date']) ." </td>                
            <td> {$day['low']}°C </td>
            <td> {$day['high']}°C </td>
            <td> {$day['pop']}% </td>
            <td> {$day['mm']}mm </td>
            <td> <img src=\"resources/images/{$day['icon']}.png\" class=\"icon\"/> </td>
            <td> {$day['phrase']} </td>
        </tr>"; 
    }?>
</table>