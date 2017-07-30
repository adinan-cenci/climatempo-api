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
use AdinanCenci\Climatempo\Climatempo;

/*-----------------------------*/

$citiesIds  = array(
    '558', /* São paulo */
    '377'  /* Florianópolis */
);

$climatempo = new Climatempo($citiesIds);
$forecast   = $climatempo->fetch();

if (! $forecast) {
    echo '<h2>Error!</h2>';
    print_r($climatempo->errors);
    die();
}

?>
<p>
    Here is the forecast for the cities of Florianópolis - SC and São Paulo - SP:
</p>

<table>
    <tr>
        <th>City</th>
        <th>Date</th>
        <th title="Lower temperature">Low</th>
        <th title="Higher temperature">Hight</th>
        <th title="Probability of precipitation">Pop</th>
        <th title="Precipitation">MM</th>
        <th>Icon</th>
        <th>Phrase</th>
    </tr>
    <?php
    foreach ($forecast as $cityName => $daysOfTheWeek) {
        foreach ($daysOfTheWeek as $day) {
            echo "
            <tr>
                <th> {$cityName} </th>
                <td> ". date('Y-m-d', $day['date']) ." </td>                
                <td> {$day['low']}°C </td>
                <td> {$day['high']}°C </td>
                <td> {$day['pop']}% </td>
                <td> {$day['mm']}mm </td>
                <td> <img src=\"resources/images/{$day['icon']}.png\" class=\"icon\"/> </td>
                <td> {$day['phrase']} </td>
            </tr>";
        }
    }?>
</table>

<?php
require 'resources/footer.html';
?>