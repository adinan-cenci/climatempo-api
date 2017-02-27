
# Clima Tempo API

*Read this in other languages: [Português](README.md)

[Climatempo](http://www.climatempo.com.br) is a brazilian online weather forecast service for brazilian cities.
They provide the option of embedding their forecast on third-party sites, but only through a flash widget.

This library reads the content of said widget's source of data and returns the forecast for the next 4 days.


## How to use it

Let's say we want the forecast for São Paulo - SP and Florianópolis - SC.  
We will need the ids for this cities:

```php

$ids = array('558'/*São paulo*/, '377'/*Florianópolis*/);

$climatempo = new ClimaTempo\ClimaTempo($ids);
$forecast = $climatempo->fetch();

foreach ($forecast as $cityName => $daysOfTheWeek) {
	foreach ($daysOfTheWeek as $day) {
		echo '
		City: <b>'.$cityName.' ('.date('Y-m-d', $day['date']).')</b>: <br>
		Min. temperature: '.$day['low'].'°C <br>
		Max. temperature: '.$day['high'].'°C <br>
		Probal. of precipitation: '.$day['pop'].'% <br>
		Precipitation: '.$day['mm'].'mm <br>
		Phrase: '.$day['phrase'].' <br>
		Icon: '.$day['icon'].'<hr>';
	}
}

```

## How can I figure out the ID of a especific city?

Unfortunately climatempo uses their own system, each brazilian city has its own id.  
But you can simple use the Search class

Let's say we want today's forecast for Rio de Janeiro - RJ:

```php

$rio 		= ClimaTempo\Search::find('rio de janeiro')[0];
$forecast 	= $rio->today();

echo '
Min. temperature: '.$forecast['low'].'°C<br>
Max. temperature: '.$forecast['high'].'°C<br>
Probal. of precipitation: '.$forecast['pop'].'%<br>
Precipitation: '.$forecast['mm'].'mm<br>
Phrase: '.$forecast['phrase'].'<br>';
Icon: '.$forecast['icon'];

```
