
# Clima Tempo Scraper

*Read this in other languages: [English](README.md)

[Climatempo](http://www.climatempo.com.br) é um serviço de previsão do tempo brasileiro.
Eles dão a opção de embutir suas previsões em sites de terceiros, mas apenas através de um widget flash.

Essa classe lê o xml fonte de dados do dito widget e retorna uma array com a previsão do tempo para os próximos 4 dias.

## Como eu descubro o ID de uma cidade em específico?

Infelizmente climatempo usa seu próprio sistema, para descobrir o id de uma cidade em específico, você precisará fuçar a página deles.
Aqui está uma lista das capitais brasileiras:

6 Rio Branco - Acre
8 Maceió - Amazonas
25 Manaus - Macapá
39 Macapá - Amapá
56 Salvador - Bahia
60 Fortaleza - Ceará
61 Brasília - Distrito Federal
84 Vitórioa - Espírito Santo
88 Goiânia - Goías
94 São Luís - Maranhão
107 Belo Horizonte - Minas Gerais
212 Campo Grande - Mato Grosso do Sul
218 Cuiabá - Mato Grosso
232 Belém - Pará
259 Recife - Pernambuco
256 João Pessoa - Paraíba
264 Teresinha - Piauí
271 Curitiba - Paraná
321 Rio de Janeiro - Rio de Janeiro
334 Natal - Rio Grande do Norte
343 Porto Velho - Rondônia
347 Boa Vista - Roraima
363 Porto Alegre - Rio Grande do Sul
377 Florianópolis - Santa Catarina
384 Aracaju - Serjipe
558 São Paulo - São Paulo
593 Palmas - Tocantins