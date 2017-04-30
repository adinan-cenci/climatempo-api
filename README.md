
# Climatempo API

*Read this in other languages: [English](README.en.md)

[Climatempo](http://www.climatempo.com.br) é um serviço de previsão do tempo para cidades brazileiras.
Eles dão a opção de embutir suas previsões em sites de terceiros, mas apenas através de um widget feito em flash.

Essa biblioteca lê a fonte de dados do dito widget e retorna a previsão do tempo para os próximos 4 dias.


## Como usar

Digamos que nós queremos a previsão para São Paulo - SP e Florianópolis - SC.  
Nós vamos precisar das ids para essas cidades:

```php

$ids = array('558'/*São paulo*/, '377'/*Florianópolis*/);

$climatempo = new Climatempo\Climatempo($ids);
$previsao = $climatempo->fetch();

foreach ($previsao as $nomeDaCidade => $diasDaSemana) {
	foreach ($diasDaSemana as $dia) {
		echo '
		Cidade: <b>'.$nomeDaCidade.' ('.date('Y-m-d', $dia['date']).')</b>: <br>
		Temp. mínima: '.$dia['low'].'°C <br>
		Temp. máxima: '.$dia['high'].'°C <br>
		Probal. de precipitação: '.$dia['pop'].'% <br>
		Precipitação: '.$dia['mm'].'mm <br>
		Frase: '.$dia['phrase'].' <br>
		Icone: '.$dia['icon'].'<hr>';
	}
}

```

## Como descobrir o ID para uma cidade em específico?

Infelizmente climatempo usa seu próprio sistema, cada cidade brazileira tem seu próprio ID.  
Mas você pode facilmente usar a classe Search.

Digamos que nós queremos a previsão para Rio de Janeiro - RJ:

```php

$rio 		= Climatempo\Search::find('rio de janeiro')[0];
$previsao 	= $rio->today();

echo '
Temp. mínima: '.$previsao['low'].'°C<br>
Temp. máxima: '.$previsao['high'].'°C<br>
Probal. de precipitação: '.$previsao['pop'].'%<br>
Precipitação: '.$previsao['mm'].'mm<br>
Frase: '.$previsao['phrase'].'<br>
Icone: '.$previsao['icon'];

```
