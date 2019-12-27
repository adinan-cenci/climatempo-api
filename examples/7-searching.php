<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/*-----------------------------*/

require '../vendor/autoload.php';

use AdinanCenci\Climatempo\City\Search;

/*-----------------------------*/

require 'resources/header.html';

echo 
'<h2>Searching for cities named "Miguel"</h2>';

$search = new Search();
$search
->name('Miguel');

$results = $search->find();
foreach ($results as $city) {
    echo "$city->state: $city->name<br>";
}

/*-----------------------------*/

echo 
'<hr>', 
'<h2>Searching for cities named "Miguel" in Tocantins</h2>';

$search = new Search();
$search
->name('Miguel')
->state('TO');

$results = $search->find();
foreach ($results as $city) {
    echo "$city->state: $city->name<br>";
}

/*-----------------------------*/

echo 
'<hr>', 
'<h2>Get the capitals by their ids</h2>';

$search = new Search();
$search->ids(7717, 6809, 3982, 7544, 7564, 8050, 8173, 8284, 6861, 6867, 7615, 6760, 6879, 7704, 7364, 6731, 7140, 6951, 5959, 5864, 5346, 5757, 5775, 4915, 3477, 4502);

$results = $search->find();
foreach ($results as $city) {
    echo "$city->id: $city->name / $city->state<br>";
}

require 'resources/footer.html';
