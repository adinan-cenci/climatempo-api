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
    protected $token;

    public function __construct($token) 
    {
        $this->token = $token;
    }

    public function fifteenDays($cityId) 
    {
        $url        = 'http://apiadvisor.climatempo.com.br/api/v1/forecast/locale/'.$cityId.'/days/15?token='.$this->token;
        $content    = $this->request($url, null, 'get', $httpCode);

        if ($httpCode != 200) {
            throw new \Exception($this->readErrorMessage($content), 1);            
        }

        return new Forecast(json_decode($content), 'AdinanCenci\Climatempo\FifteenDays');        
    }

    public function seventyTwoHours($cityId) 
    {
        $url        = 'http://apiadvisor.climatempo.com.br/api/v1/forecast/locale/'.$cityId.'/hours/72?token='.$this->token;
        $content    = $this->request($url, null, 'get', $httpCode);

        if ($httpCode != 200) {
            throw new \Exception($this->readErrorMessage($content), 1);            
        }

        return new Forecast(json_decode($content), 'AdinanCenci\Climatempo\SeventyTwoHours');
    }

    public function current($cityId) 
    {
        $url        = 'http://apiadvisor.climatempo.com.br/api/v1/weather/locale/'.$cityId.'/current?token='.$this->token;
        $content    = $this->request($url, null, 'get', $httpCode);

        if ($httpCode != 200) {
            throw new \Exception($this->readErrorMessage($content), 1);            
        }

        return new Weather(json_decode($content));
    }

    public function getCityById($cityId) 
    {
        $url        = 'http://apiadvisor.climatempo.com.br/api/v1/locale/city/'.$cityId.'?token='.$this->token;
        $content    = $this->request($url, null, 'get', $httpCode);

        if ($httpCode != 200) {
            throw new \Exception($this->readErrorMessage($content), 1);            
        }

        return json_decode($content, true);
    }

    /**
     * This will not look up for fragments, if you want to search for a city Id 
     * with this method, you'll need the full gramatic correct name of the city
     */
    public function findCity($name, $state = '') 
    {
        $url = 
        'http://apiadvisor.climatempo.com.br/api/v1/locale/city?name='.$name.
        ($state ? '&state='.$state : '').
        '&token='.$this->token;

        $content = $this->request($url, null, 'get', $httpCode);

        if ($httpCode != 200) {
            throw new \Exception($this->readErrorMessage($content), 1);            
        }

        return json_decode($content, true);
    }

    /**
     * @param string $url
     * @param array $data
     * @param string $method
     * @param int $httpCode Will return the request code
     * @return string
     */
    protected function request($url, $data = null, $method = 'get', &$httpCode = null) 
    {
        $method     = strtolower($method);

        $ch         = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if ($method == 'post') {
            curl_setopt($ch, CURLOPT_POST, 1);
        }

        if ($data and is_array($data)) {
            $data = http_build_query($data);
        }

        if ($method == 'post' and $data) {            
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        $content    = curl_exec($ch);
        $httpCode   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        return $content;
    }

    protected function readErrorMessage($content) 
    {
        $json = json_decode($content, true);
        if (json_last_error() != JSON_ERROR_NONE) {
            return $content;
        }

        return isset($json['detail']) ? $json['detail'] : $content;
    }
}
