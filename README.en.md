
# Climatempo API

*Read this in other languages: [Portuguese](README.md)  

[Climatempo](http://www.climatempo.com.br) is a weather forecast service for brazilian cities.
They offer a REST API for developers and the goal of this library is to 
make it simple to request forecasts using said API.

## How to install

Use composer

```bash
composer require adinan-cenci/climatempo-api
```

## How can I acquire an access token?
Access [advisor.climatempo.com.br](http://advisor.climatempo.com.br) and create an account.

## How to use it
Let's say we want the forecast for São Paulo - SP.  
We'll need the id for this city:

```php

use AdinanCenci\Climatempo\Climatempo;

$token      = 'insert-your-token-here';
$id         = 3477; /*São paulo*/

$climatempo = new Climatempo($token);
$forecast   = $climatempo->fifteenDays($id);


foreach ($forecast->days as $dia) {
    echo 
    "City: <b>$forecast->city ($dia->date)</b>: <br>
    Min. temperature: $dia->minTemp °C <br>
    Max. temperature: $dia->maxTemp °C <br>
    Probability of precipitation: $dia->pop % <br>
    Precipitation: $dia->mm mm <br>
    Phrase: $dia->textPt <hr>";
}
```

Vai resultar em: 

City: **São Paulo (2017-12-06)**:  
Min. temperature: 21 °C  
Max. temperature: 32 °C  
Probability of precipitation: %  
Precipitation: mm  
Phrase: Sol com algumas nuvens  
___

City: **São Paulo (2017-12-07)**:  
Min. temperature: 18 °C  
Max. temperature: 24 °C  
Probability of precipitation: 75 %  
Precipitation: 2 mm  
Phrase: Sol e Chuva  
___

City: **São Paulo (2017-12-08)**:  
Min. temperature: 16 °C  
Max. temperature: 20 °C  
Probability of precipitation: 75 %  
Precipitation: 3 mm  
Phrase: Sol e Chuva  
___


## How to get a city's forecast without it's ID?
Unfortunately climatempo uses their own system, each city has it's own ID.
But you can easily use the Search class to find the city you are looking for.

Let's say we want the forecast for Rio de Janeiro - RJ:

```php

use AdinanCenci\Climatempo\Search;

$searching     = new Search();
$searching->name('rio de janeiro');

$rio = $searching->find()[0]; // object City

```

Then you can get the forecast by using the methods below:

```php

$rio->fifteenDays($token);              // returns the forecast for the next 15 days
$rio->seventyTwoHours($token);          // returns the forecast for the next 72 hours
$rio->current($token);                  // returns the current state of the weather

$rio->today($token);                    // returns the forecast for today
$rio->tomorow($token);                  // returns the forecast for tomorow
$rio->afterTomorow($token);             // returns the forecast for the day after tomorow

```

## Searching
Speaking about searching, the Search class allow us to narrow down to the state.  
The example below will search for all the cities with "rio" in it's name, inside the Rio de Janeiro state.

```php

use AdinanCenci\Climatempo\Search;

$searching = new Search();
$searching
->name('rio')
->state('RJ');

$searching->find(); // returns array

```

See other examples inside the directory "examples".

## License
License MIT