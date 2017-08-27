
# Climatempo API

*Read this in other languages: [English](README.en.md)

[Climatempo](http://www.climatempo.com.br) é um serviço de previsão do tempo para cidades brasileiras.
Eles dão a opção de embutir suas previsões em sites de terceiros, mas apenas através de um widget feito em flash.

Essa biblioteca lê a fonte de dados do dito widget e retorna a previsão do tempo para os próximos 4 dias.

## Como instalar

Use composer

```bash
composer require adinan-cenci/climatempo-api
```


## Como usar

Digamos que nós queremos a previsão para São Paulo - SP.  
Nós vamos precisar do id para essa cidade:

```php

use AdinanCenci\Climatempo\Climatempo;

$ids        = array('558'/*São paulo*/);

$climatempo = new Climatempo($ids);
$previsao   = $climatempo->fetch();

foreach ($previsao as $nomeDaCidade => $diasDaSemana) {
    foreach ($diasDaSemana as $dia) {
        echo "
        Cidade: <b>$nomeDaCidade (".date('Y-m-d', $dia['date']).")</b>: <br>
        Temp. mínima: {$dia['low']}°C <br>
        Temp. máxima: {$dia['high']}°C <br>
        Probal. de precipitação: {$dia['pop']}% <br>
        Precipitação: {$dia['mm']}mm <br>
        Frase: {$dia['phrase']} <br>
        Icone: {$dia['icon']}<hr>";
    }
}
```

Vai resultar em: 

idade: **SP - São Paulo (2017-08-27)**:  
Temp. mínima: 14°C  
Temp. máxima: 28°C  
Probal. de precipitação: 0%  
Precipitação: 0mm  
Frase: Sol o dia todo sem nuvens no céu. Noite de tempo aberto ainda sem nuvens.  
Icone: sun
___

Cidade: **SP - São Paulo (2017-08-28)**:  
Temp. mínima: 13°C  
Temp. máxima: 28°C  
Probal. de precipitação: 0%  
Precipitação: 0mm  
Frase: Sol o dia todo sem nuvens no céu. Noite de tempo aberto ainda sem nuvens.  
Icone: sun
___

Cidade: **SP - São Paulo (2017-08-29)**:  
Temp. mínima: 14°C  
Temp. máxima: 29°C  
Probal. de precipitação: 0%  
Precipitação: 0mm  
Frase: Sol o dia todo sem nuvens no céu. Noite de tempo aberto ainda sem nuvens.  
Icone: sun
___

Cidade: **SP - São Paulo (2017-08-30)**:  
Temp. mínima: 15°C  
Temp. máxima: 31°C  
Probal. de precipitação: 0%  
Precipitação: 0mm  
Frase: Sol o dia todo sem nuvens no céu. Noite de tempo aberto ainda sem nuvens.  
Icone: sun
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

Você pode acessar a previsão através da propriedade "forecast"

```php

$rio->forecast;             // retorna a previsão inteira
$rio->today;                // retorna a previsão para hoje
$rio->tomorrow;             // ... de amanhã
$rio->afterTomorrow;        // depois de amanhã
$rio->afterAfterTomorrow;   // depois, depois de amanhã

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

## Licença

Licença MIT