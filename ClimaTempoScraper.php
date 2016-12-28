<?php
/**
 * Clima Tempo Scraper
 *
 * A web scrapper written in PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2016, Adinan Cenci
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author	Adinan Cenci
 * @copyright	Copyright (c) 2016, Adinan Cenci
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://github.com/AdinanCenci/climatempo-scraper
 */

class ClimaTempoScraper
{

	/**
	 * array containing the ids for the desired cities
	 * @property array $citiesIds
	 */
	protected $citiesIds = array();

	/**
	 * @param array|int $ids id(s) of the desired city(ies), 5 tops
	 */
	public function __construct($ids) 
	{
		$this->setIds($ids);
	}

	/**
	 * @param array|int $ids
	 */
	public function setIds($ids) 
	{
		$this->citiesIds = is_array($ids) ? $ids : array($ids);
	}

	/**
	 * @param int $id
	 */
	public function addId($id) 
	{
		$this->citiesIds[] = $id;
	}

	/**
	 * It will return a multidimensioanl array with the forecast for each city like:
	 * city-name: [{date, low, high, prob, mm, icon, phrase}, {date, low ... ]
	 * icon is supposed to represents a unique graphic icon to display the weather. 1: sun, 2: sun and clouds, 3: clouds, 4: sun and rain, 5: rain, 6: storm, 7: snow, 8: snow storm, 9: fog
	 * @return array
	 */
	public function fetch() 
	{
		$xml = $this->request();

		/**
		 * <selos>
		 * 		<video>
		 *		<parametro>
		 *		<cidade nome="" data="" low="" hight="" prob="" mm="" ico="" frase="/>
		 *		...
		*/

		$xml = mb_convert_encoding($xml, 'UTF-8', 'ISO-8859-1');
		$xml = str_replace(array("\n", "\r", "\t"), '', $xml);
		$dom = new SimpleXMLElement($xml);
		$children = $dom->children();

		$l = count($children);

		$cyties = array();

		//ignore the first two nodes video and parametro
		for($n = 2; $n < $l; $n++) {

			$indice = (string)$children[$n]['nome'];//the city's name

			if(!isset($cyties[$indice])) {
				$cyties[$indice] = array();
			}

			$date = (string)$children[$n]['data'];
			$date = $this->sanitizeDate($date);

			$phrase = (string)$children[$n]['frase'];

			$cyties[$indice][] = array(
				'date' => $date,
				'low' => (string) $children[$n]['low'],
				'high' => (string) $children[$n]['high'],
				'prob' => (string) $children[$n]['prob'],
				'mm' => (string) $children[$n]['mm'],
				'icon' => (int) $children[$n]['ico'],
				'phrase' => $phrase,
			);
		}

		return $cyties;
	}

	/**
	 * Sanitizes the date into a timestamp
	 * @param string $date
	 * @return int
	 */
	protected function sanitizeDate($date) 
	{
		//Enters: 28/12 Qua
		preg_match('/^([0-9]{2})\/([0-9]{2})/', $date, $matches);
		$year = date('Y');
		return mktime(0, 0, 0, $matches[2], $matches[1], $year);
	}

	/**
	 * Makes the request to climatempo.com.br
	 * @return string xml
	 */
	protected function request() 
	{
		$ids = array_slice($this->citiesIds, 0, 5);

		$url = 'http://selos.climatempo.com.br/selos/selo.php?CODCIDADE=';
		$url .= implode(',', $ids);

		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		$content = curl_exec($ch);
		curl_close($ch);

		return $content;
	}
}