<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'resources/header.html';

/*-----------------------------*/

require '../src/Search.php';
require '../src/City.php';

use AdinanCenci\Climatempo\Search;

/*------------------------*/

echo '<h2>Searching for cities named "Miguel"</h2>';

$search = new Search();
$search
->name('Miguel');

$results = $search->find();
foreach ($results as $city) {
    echo "$city->state: $city->name<br>";
}

echo '<hr>';




echo '<h2>Searching for cities named "Miguel" in Tocantins</h2>';

$search = new Search();
$search
->name('Miguel')
->state('TO');

$results = $search->find();
foreach ($results as $city) {
    echo "$city->state: $city->name<br>";
}

echo '<hr>';




echo '<h2>Get the capitals by theyr ids</h2>';

$search = new Search();
$search->ids(6, 8, 25, 39, 56, 60, 61, 84, 88, 94, 107, 212, 218, 232, 256, 259, 264, 271, 321, 334, 343, 347, 363, 377, 384, 558, 593);

$results = $search->find();
foreach ($results as $city) {
	echo "$city->state: $city->name<br>";
}


require 'resources/footer.html';
?>