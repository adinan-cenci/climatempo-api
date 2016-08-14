<?php

/**
 * @author Adinan Cenci <adinancenci@gmail.com>
 */

class ClimaTempo 
{
	protected $citiesIds = null;
		
	public function __construct($citiesIds) 
	{
		if(is_array($citiesIds)) {
			$this->citiesIds = array_slice($citiesIds, 0, 5);//5 ids tops
		} else {		
			$this->citiesIds = array($citiesIds);
		}
	}


	public function fetch() 
	{
		$xml = $this->request($this->citiesIds);
		$xml = mb_convert_encoding($xml, "UTF-8", "ISO-8859-1");
		$xml = str_replace(array("\n", "\r", "\t"), '', $xml);
		
		/**
		 * <selos>
		 * 		<video>
		 *		<parametro>
		 *		<cidade nome="" data="" low="" hight="" prob="" mm="" ico="" frase="/>
		 *		...
		*/

		$dom = new SimpleXMLElement($xml);
		$children = $dom->children();
		$l = count($children);

		$cyties = array();

		//ignore the first two nodes
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
				'low' => (string)$children[$n]['low'],
				'high' => (string)$children[$n]['high'],
				'prob' => (string)$children[$n]['prob'],
				'mm' => (string)$children[$n]['mm'],
				'icon' => (int)$children[$n]['ico'],
				'phrase' => $phrase,
			);
		}

		return $cyties;
	}


	protected function sanitizeDate($date) 
	{
		preg_match('/^([0-9]{2})\/([0-9]{2})/', $date, $matches);
		$year = date('Y');
		return mktime(0, 0, 0, $matches[2], $matches[1], $year);
	}


	protected function request($citiesIds) 
	{
		$ch = curl_init();		
		curl_setopt ($ch, CURLOPT_URL, 'http://selos.climatempo.com.br/selos/selo.php?CODCIDADE='.implode(',', $citiesIds));
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		$conteudo = curl_exec($ch);
		curl_close($ch);

		return $conteudo;
	}
}