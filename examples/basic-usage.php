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
     * The class ClimaTempo makes the requisitions to the
     * climatempo server, reads the XML and returns an array
     * 
     */

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    /*-----------------------------*/

    require '../src/Climatempo.php';
    use AdinanCenci\Climatempo as CT;

    /*-----------------------------*/
    
    $citiesIds = array('558'/*São paulo*/, '377'/*Florianópolis*/);
    $climatempo = new CT\Climatempo($citiesIds);
    $forecast = $climatempo->fetch();

    /*-----------------------------*/

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
        foreach ($daysOfTheWeek as $day) {?>
            <tr>
                <th> <?php echo $cityName;?> </th>
                <td> <?php echo date('Y-m-d', $day['date']);?> </td>                
                <td> <?php echo $day['low'].'°C';?> </td>
                <td> <?php echo $day['high'].'°C';?> </td>
                <td> <?php echo $day['pop'].'%';?> </td>
                <td> <?php echo $day['mm'].'mm';?> </td>
                <td> <img src="<?php echo 'images/'.$day['icon'].'.png';?>" class="icon"/> </td>
                <td> <?php echo $day['phrase'];?> </td>
            </tr>
        <?php
        }
    }?>
    </table>
    
    
</body>
</html>