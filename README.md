
# Clima Tempo Scraper

*Read this in other languages: [Português](README.pt.md)

[Climatempo](http://www.climatempo.com.br) is a brazilian online weather forecast service.
They provide the option of embedding their forecast on third-party sites, but only through a flash widget.

This class scraps the content of said widget's source of data and returns an array with the forecast for the next 4 days.

## How can I figure out the ID for a especific city?

Unfortunately climatempo uses their own system, in order to figure out the id for a specific city, you will need to dig around their webpage.
Here is a list of the brazilian capitals:

- 6 Rio Branco - Acre
- 8 Maceió - Amazonas
- 25 Manaus - Macapá
- 39 Macapá - Amapá
- 56 Salvador - Bahia
- 60 Fortaleza - Ceará
- 61 Brasília - Distrito Federal
- 84 Vitórioa - Espírito Santo
- 88 Goiânia - Goías
- 94 São Luís - Maranhão
- 107 Belo Horizonte - Minas Gerais
- 212 Campo Grande - Mato Grosso do Sul
- 218 Cuiabá - Mato Grosso
- 232 Belém - Pará
- 259 Recife - Pernambuco
- 256 João Pessoa - Paraíba
- 264 Teresinha - Piauí
- 271 Curitiba - Paraná
- 321 Rio de Janeiro - Rio de Janeiro
- 334 Natal - Rio Grande do Norte
- 343 Porto Velho - Rondônia
- 347 Boa Vista - Roraima
- 363 Porto Alegre - Rio Grande do Sul
- 377 Florianópolis - Santa Catarina
- 384 Aracaju - Serjipe
- 558 São Paulo - São Paulo
- 593 Palmas - Tocantins