<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
	* {
		box-sizing: border-box;
		-moz-box-sizing: border-box;
		-webkit-box-sizing: border-box;
	}

	body {
		padding: 20px;
		margin: 0px;
		font-family: 'Roboto', 'Ubuntu', Arial;
		font-size: 12px;
		line-height: 1.3em;

		background-color: #FAFAFA;
	}

	table {
		border-collapse: collapse;
		border: solid 1px #e6e6e6;
	}
	
	table {
		color: #666;
		background-color: #fff
	}
		td, th {
			padding: 10px;
		}

		th {
			color: #000;
			background-color: #e6e6e6;
		}

		td {
			background-color: #FFFFFF;
		}

	</style>
</head>
<body>	
	<?php

	/**
	 * Example of usage
	 */

	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	require 'functions.php';//cache functionality, just for this example
	require 'ClimaTempo.php';

	$citiesIds = array('558'/*São paulo*/, '377'/*Florianópolis*/);

	$forecast = getCache($citiesIds);
	if(!$forecast) {		
		$climatempo = new ClimaTempo($citiesIds);
		$forecast = $climatempo->fetch();
		setCache($citiesIds, $forecast);
	}

	$icons = array(
		1 => 'sun', 
		'sun-and-clouds', 
		'clouds', 
		'sun-and-rain', 
		'rain', 
		'storm', 
		'snow', 
		'snow-storm', 
		'fog'
	);
	?>

	<table>
	<tr>
		<th>City</th>
		<th>Date</th>
		<th>Low</th>
		<th>Hight</th>
		<th>Prob</th>
		<th>MM</th>
		<th>Icon</th>
		<th>Phrase</th>
	</tr>
	<?php
	foreach ($forecast as $cityName => $daysOfTheWeek) {
		foreach ($daysOfTheWeek as $day) {?>
			<tr>
				<th>
					<?php echo $cityName;?>
				</th>
				<td>
					<?php echo date('Y-m-d', $day['date']);?>
				</td>				
				<td>
					<?php echo $day['low'];?>
				</td>
				<td>
					<?php echo $day['high'];?>
				</td>
				<td>
					<?php echo $day['prob'];?>
				</td>
				<td>
					<?php echo $day['mm'];?>
				</td>
				<td>
					<?php echo $icons[$day['icon']];?>
				</td>
				<td>
					<?php echo $day['phrase'];?>
				</td>
			</tr>
		<?php
		}
	}?>
	</table>
	
	
</body>
</html>