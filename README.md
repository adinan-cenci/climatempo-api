
# Climatempo API
*Read this in other languages: [English](README.en.md)  

[Climatempo](http://www.climatempo.com.br) é um serviço de previsão do tempo para cidades brasileiras.
Eles oferece uma API do tipo REST para desenvolvedores e o objetivo desta biblioteca é fazer simples a requisição de previsão de tempo via dita API.



## Aonde consigo o token de acesso?
Acesse [advisor.climatempo.com.br](http://advisor.climatempo.com.br) e crie uma conta.



## Registrando cidades ao seu token
Antes de requisitar previsões para uma cidade em específico, você precisa registrar o id daquela cidade ao seu token:

```php
use AdinanCenci\Climatempo\Climatempo;

$token      = 'seu-token-aqui';
$locales 	= array(3477 /*São paulo*/, 5959 /*Rio de Janeiro*/, 8050 /*Fortaleza*/);
$climatempo = new Climatempo($token);

$ids 		= $climatempo->addLocalesToToken($locales);
```



## Como usar
Digamos que nós queremos a previsão para São Paulo - SP.  
Nós vamos precisar do id para essa cidade:

```php
use AdinanCenci\Climatempo\Climatempo;

$token      = 'seu-token-aqui';
$id         = 3477; /*São paulo*/

$climatempo = new Climatempo($token);
$previsao   = $climatempo->fifteenDays($id);

foreach ($previsao->days as $dia) {
    echo 
    "Cidade: <b>$previsao->city ($dia->date)</b>: <br>
    Temp. mínima: $dia->minTemp °C <br>
    Temp. máxima: $dia->maxTemp °C <br>
    Probab. de precipitação: $dia->pop % <br>
    Precipitação: $dia->mm mm <br>
    Frase: $dia->textPt <hr>";
}
```

Vai resultar em: 

Cidade: **São Paulo (2017-12-06)**:  
Temp. mínima: 21 °C  
Temp. máxima: 32 °C  
Probab. de precipitação: %  
Precipitação: mm  
Frase: Sol com algumas nuvens  
___

Cidade: **São Paulo (2017-12-07)**:  
Temp. mínima: 18 °C  
Temp. máxima: 24 °C  
Probab. de precipitação: 75 %  
Precipitação: 2 mm  
Frase: Sol e Chuva  
___

Cidade: **São Paulo (2017-12-08)**:  
Temp. mínima: 16 °C  
Temp. máxima: 20 °C  
Probab. de precipitação: 75 %  
Precipitação: 3 mm  
Frase: Sol e Chuva  
___



## Inundação
É possivel recuperar dados sobre risco de inundação através da latitude e longitude.

```php
use AdinanCenci\Climatempo\Climatempo;

$token      = 'seu-token-aqui';
$latitude   = '-23.6733566'; /*São paulo*/
$longitude  = '-46.8851047,10'; 

$climatempo = new Climatempo($token);
$risk 		= $climatempo->floodingRisk($latitude, $longitude);

echo 
'<b>'.$risk->latitude.' '.$risk->longitude.'</b><br>';
foreach ($risk->data as $data) {
    echo 
    'Valor agora: '.$data->valueNow.'<br />
    Agora: '.date('d / M / Y, H:i:s', $data->now).'<br />
	<br />
    Valor próxima hora: '.$data->valueNextHour.'<br />
    Próxima hora: '.date('d / M / Y, H:i:s', $data->nextHour).
    '___';
}
```

Vai resultar em: 

**-23.18400435255711 -46.28138759172782**
Valor agora: 0
Agora: 26 / Dec / 2019, 16:00:00

Valor próxima hora: 0
Próxima hora: 26 / Dec / 2019, 17:00:00
___



## Como ter a previsão de uma cidade sem saber o ID?
Infelizmente o climatempo usa seu próprio sistema, cada cidade brasileira tem seu próprio ID.
Mas você pode facilmente usar a classe Search para encontrar a cidade que procura.

Digamos que nós queremos a previsão para Rio de Janeiro - RJ:

```php
use AdinanCenci\Climatempo\Search;

$pesquisa     = new Search();
$pesquisa->name('rio de janeiro');

$rio = $pesquisa->find()[0]; // objeto City
```

Então você pode acessar a previsão através dos seguintes metodos:

```php
$rio->fifteenDays($token);              // retorna a previsão para os próximos 15 dias
$rio->seventyTwoHours($token);          // retorna a previsão para as próximas 72 horas
$rio->current($token);                  // retorna o estado do clima neste instante 

$rio->today($token);                    // retorna a previsão para hoje
$rio->tomorow($token);                  // retorna a previsão para amanhã
$rio->afterTomorow($token);             // retorna a previsão para depois de amanhã
```



## Pesquisando
Falando em pesquisa, a classe Search nos permite a restringir a busca à estados.  
O exemplo abaixo vai pesquisar por todas as cidades com "rio" no nome no estado do Rio de Janeiro.

```php
use AdinanCenci\Climatempo\Search;

$pesquisa = new Search();
$pesquisa
->name('rio')
->state('RJ');

$pesquisa->find(); // retorna array
```

Veja outros exemplos na pasta "examples".



## Como instalar
Use composer

```bash
composer require adinan-cenci/climatempo-api
```



## Licença
Licença MIT