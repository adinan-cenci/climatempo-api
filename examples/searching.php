<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="stylesheet.css">
</head>
<body>	
	<?php

	/**
	 * # Example of usage
	 * 
	 * If you don't know the id of a city, just search for it
	 */

	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	/*-----------------------------*/

	require '../src/Climatempo.php';
	require '../src/Search.php';
	require '../src/City.php';
	
	use Climatempo as CT;

	/*-----------------------------*/
	
	$beloHorizonte = CT\Search::find('belo horizonte')[0];
	$forecast = $beloHorizonte->getForecast();

	/*-----------------------------*/

	?>

	<p>
		Here is the forecast for the citiy of Belo Horizonte - MG:
	</p>

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
	foreach ($forecast as $day) {?>
		<tr>
			<td> <?php echo date('Y-m-d', $day['date']);?> </td>				
			<td> <?php echo $day['low'].'°C';?> </td>
			<td> <?php echo $day['high'].'°C';?> </td>
			<td> <?php echo $day['pop'].'%';?> </td>
			<td> <?php echo $day['mm'].'mm';?> </td>
			<td> <img src="<?php echo 'images/'.$day['icon'].'.png';?>" class="icon"/> </td>
			<td> <?php echo $day['phrase'];?> </td>
		</tr>
	<?php		
	}?>
	</table>

	
	
</body>
</html>