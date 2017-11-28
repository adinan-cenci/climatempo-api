<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'resources/header.html';

/*-----------------------------*/

require '../src/Search.php';
require '../src/City.php';

use AdinanCenci\Climatempo\Search;

/*-----------------------------*/

echo 
'<h2>Searching for cities named "Miguel"</h2>';

$search = new Search();
$search
->name('Miguel');

$results = $search->find();
foreach ($results as $city) {
    echo "$city->state: $city->name<br>";
}

echo 
'<hr>';

/*-----------------------------*/

echo 
'<h2>Searching for cities named "Miguel" in Tocantins</h2>';

$search = new Search();
$search
->name('Miguel')
->state('TO');

$results = $search->find();
foreach ($results as $city) {
    echo "$city->state: $city->name<br>";
}

echo 
'<hr>';

/*-----------------------------*/

echo 
'<h2>Get the capitals by their ids</h2>';

$search = new Search();
$search->ids(7717, 6809, 3982, 7544, 7564, 8050, 8173, 8284, 8303, 8307, 6861, 6867, 8501, 7615, 6760, 6879, 7704, 7364, 6731, 7140, 6951, 5959, 5864, 5346, 5757, 5775, 4915, 3477, 4502);

$results = $search->find();
foreach ($results as $city) {
	echo "$city->state: $city->name<br>";
}

require 'resources/footer.html';
