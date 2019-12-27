<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/*-----------------------------*/

require '../vendor/autoload.php';

use AdinanCenci\Climatempo\Climatempo;

/*-----------------------------*/

$token      = 'insert-your-token-here';
$climatempo = new Climatempo($token);

$locales    = array(3477 /*São paulo*/, 5959 /*Rio de Janeiro*/, 8050 /*Fortaleza*/);

try {
    $cities = $climatempo->addLocalesToToken($locales);
} catch (Exception $e) {
    echo '<b>Error: </b>'.$e->getMessage();
    die();
}

/*-----------------------------*/

require 'resources/header.html';

echo 
"<h2>This token is associated with the following cities ids</h2>", 
implode(', ', $cities);

require 'resources/footer.html';
