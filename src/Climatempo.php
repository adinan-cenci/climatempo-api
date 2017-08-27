<?php
/**
 * Climatempo Api
 *
 * A weather forecast api written in PHP
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
 * @author  Adinan Cenci
 * @copyright   Copyright (c) 2016, Adinan Cenci
 * @license http://opensource.org/licenses/MIT  MIT License
 * @link    https://github.com/adinan-cenci/climatempo-api
 */

namespace AdinanCenci\Climatempo;

class Climatempo
{
    /**
     * array containing the ids for the desired cities
     * @var array $citiesIds
     */
    protected $citiesIds = array();

    protected $icons = array(
        1 => 'sun', 
        'sun-and-clouds', 
        'clouds', 
        'sun-and-rain', 
        'rain', 
        'storm', 
        'snow', 
        'snow-storm', 
        'fog'
    );

    protected $errors = array();

    /**
     * @param array|int $ids id(s) of the desired city(ies), 5 tops
     */
    public function __construct($ids) 
    {
        if (is_array($ids)) {
            $this->setIds($ids);
        } else {
            $this->setIds(func_get_args());
        }
    }

    public function __get($var) 
    {
        if ($var == 'errors') {
            return $this->errors;
        }
    }

    /**
     * @param array|int $ids
     * @return $this
     */
    public function setIds($ids) 
    {
        $this->citiesIds = is_array($ids) ? $ids : array($ids);
        return $this;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function addId($id) 
    {
        $this->citiesIds[] = $id;
        return $this;
    }

    /**
     * Attempt to make a request,
     * read the xml and return the 
     * data in array form
     * @return array|false
     */
    public function fetch() 
    {
        $xml = $this->request();
        if (! $xml) {
            return false;
        }

        $dom = $this->simpleXml($xml);
        if (! $dom) {
            return false;
        }

        return $this->readDom($dom);
    }

    /**
     * It will return a multidimensioanl array with the forecast for each city like:
     * city-name: [{date, low, high, prob, mm, icon, phrase}, {date, low ... ]
     * icon is supposed to represents a unique graphic icon to display the weather.
     * @param \SimpleXMLElement $dom
     * @return array
     */
    protected function readDom(\SimpleXMLElement $dom) 
    {
        /**
         * <selos>
         *      <video>
         *      <parametro>
         *      <cidade nome="" data="" low="" hight="" prob="" mm="" ico="" frase="/>
         *      ...
        */

        $children   = $dom->children();

        $l          = count($children);

        $cyties     = array();

        // ignore the first two nodes, video and parametro
        for ($n = 2; $n < $l; $n++) {

            $indice = (string) $children[$n]['nome']; // the city's name

            if (! isset($cyties[$indice])) {
                $cyties[$indice] = array();
            }

            $date = (string) $children[$n]['data'];
            $date = $this->sanitizeDate($date);

            $icon = (int) $children[$n]['ico'];
            $icon = $this->icons[$icon];

            $cyties[$indice][] = array(
                'date'      => $date,
                'low'       => (string) $children[$n]['low'],   // lower temperature (°C)
                'high'      => (string) $children[$n]['high'],  // higher temperature (°C)
                'pop'       => (string) $children[$n]['prob'],  // probability of precipitation (%)
                'mm'        => (string) $children[$n]['mm'],    // precipitation (mm)
                'icon'      => $icon,                           // graphical representation
                'phrase'    => (string) $children[$n]['frase']  // description
            );
        }

        return $cyties;
    }

    /**
     * Sanitizes the date into a timestamp
     * @param string $date
     * @return int timestamp
     */
    protected function sanitizeDate($date, $year = null) 
    {
        // Expected: "28/12 Qua" (day of the month/month day)
        preg_match('/^([0-9]{1,2})\/([0-9]{1,2})/', $date, $matches);
        if (! $year) { $year = date('Y');}
        return mktime(0, 0, 0, $matches[2], $matches[1], $year);
    }

    /**
     * Attempts to instantiate a SimpleXMLElement 
     * out of the xml parameter
     * @param string $xml
     * @return \SimpleXMLElement|false
     */
    protected function simpleXml($xml) 
    {
        $xml = mb_convert_encoding($xml, 'UTF-8', 'ISO-8859-1');
        $xml = str_replace(array("\n", "\r", "\t"), '', $xml);

        $dom = simplexml_load_string($xml);
        
        if (! $dom) {
            // bad response, invalid xml
            $this->errors[] = 'Problems with the request';
            return false;
        }

        return $dom;
    }

    /**
     * Makes the request to climatempo.com.br
     * @return string|false xml data
     */
    protected function request() 
    {
        $ids = array_slice($this->citiesIds, 0, 5);

        $url = 'http://selos.climatempo.com.br/selos/selo.php?CODCIDADE=';
        $url .= implode(',', $ids);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $content  = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($content == false or $httpCode != 200) {
            // internet connection problem or climatempo offline
            $this->errors[] = 'Unable to connect to climatempo.';
            return false;
        }

        return $content;
    }
}