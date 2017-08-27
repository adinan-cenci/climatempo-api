
# Climatempo API

*Read this in other languages: [Português](README.md)

[Climatempo](http://www.climatempo.com.br) is an online weather forecast service for brazilian cities.
They provide the option of embedding their forecast on third-party sites, but only through a flash widget.

This library reads the content of said widget's source of data and returns the forecast for the next 4 days.

## How to install

Use composer

```bash
composer require adinan-cenci/climatempo-api
```

## How to use it

Let's say we want the forecast for São Paulo - SP.  
We will need the id for this city:

```php

use AdinanCenci\Climatempo\Climatempo;

$ids        = array('558'/*São paulo*/);

$climatempo = new Climatempo($ids);
$forecast   = $climatempo->fetch();

foreach ($forecast as $cityName => $daysOfTheWeek) {
    foreach ($daysOfTheWeek as $day) {
        echo "
        City: <b>$cityName (".date('Y-m-d', $day['date']).")</b>: <br>
        Min. temperature: {$day['low']}°C <br>
        Max. temperature: {$day['high']}°C <br>
        Probal. of precipitation: {$day['pop']}% <br>
        Precipitation: {$day['mm']}mm <br>
        Phrase: {$day['phrase']} <br>
        Icon: {$day['icon']}<hr>";
    }
}
```

Will result in:

City: **SP - São Paulo (2017-08-27)**:  
Min. temperature: 14°C  
Max. temperature: 28°C  
Probal. of precipitation: 0%  
Precipitation: 0mm  
Phrase: Sol o dia todo sem nuvens no céu. Noite de tempo aberto ainda sem nuvens.  
Icon: sun
___

City: **SP - São Paulo (2017-08-28)**:  
Min. temperature: 13°C  
Max. temperature: 28°C  
Probal. of precipitation: 0%  
Precipitation: 0mm  
Phrase: Sol o dia todo sem nuvens no céu. Noite de tempo aberto ainda sem nuvens.  
Icon: sun
___

City: **SP - São Paulo (2017-08-29)**:  
Min. temperature: 14°C  
Max. temperature: 29°C  
Probal. of precipitation: 0%  
Precipitation: 0mm  
Phrase: Sol o dia todo sem nuvens no céu. Noite de tempo aberto ainda sem nuvens.  
Icon: sun
___

City: **SP - São Paulo (2017-08-30)**:  
Min. temperature: 15°C  
Max. temperature: 31°C  
Probal. of precipitation: 0%  
Precipitation: 0mm  
Phrase: Sol o dia todo sem nuvens no céu. Noite de tempo aberto ainda sem nuvens.  
Icon: sun
___


## How to get the forecast for a city without knowing its ID?

Unfortunately climatempo uses their own system, each brazilian city has its own id.  
But you can easily use the class Search to find the city you are looking for.

Let's say we want today's forecast for Rio de Janeiro - RJ:

```php

use AdinanCenci\Climatempo\Search;

$search = new Search();
$search->name('rio de janeiro');

$rio = $search->find()[0]; // object City

```

You may access the forecast through the property "forecast"

```php

$rio->forecast;         // returns the entire forecast
$rio->today;            // returns the forecast for today
$rio->tomorrow;         // ...
$rio->afterTomorrow;
$rio->afterAfterTomorrow;

```

## Searching

Speaking of searching, the Search class allow us to narrow down the scope by state.  
The example below will search for all cities wich names contain the word "rio" in the state of 
Rio de Janeiro.

```php

use AdinanCenci\Climatempo\Search;

$search = new Search();
$search
->name('rio')
->state('RJ');

$search->find(); // returns array

```


See other examples inside the folder "examples".

## License

MIT License
