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
        $content    = $this->request($url, 'get', $httpCode);

        //$content = '{"id":3477,"name":"S\u00e3o Paulo","state":"SP","country":"BR ","data":[{"date":"2017-12-09","date_br":"09/12/2017","humidity":{"min":59,"max":100},"rain":{"probability":null,"precipitation":null},"wind":{"velocity_min":7,"velocity_max":15,"velocity_avg":10,"gust_max":6.5,"direction_degrees":145,"direction":"SE"},"uv":{"max":13},"thermal_sensation":{"max":32.8,"min":20.5},"text_icon":{"icon":{"dawn":"2","morning":"2","afternoon":"2","night":"2","day":"2"},"text":{"pt":"Sol com algumas nuvens","en":"Mostly sunny.","es":"Sol con algunas nubes. No llueve.","phrase":{"reduced":"Sol com algumas nuvens. N\u00e3o chove.","morning":"Sol com algumas nuvens","afternoon":"Sol com algumas nuvens","night":"Algumas nuvens","dawn":"Algumas nuvens"}}},"temperature":{"min":18,"max":27,"morning":{"min":18,"max":21},"afternoon":{"min":24,"max":27},"night":{"min":19,"max":25}}},{"date":"2017-12-10","date_br":"10/12/2017","humidity":{"min":54,"max":100},"rain":{"probability":null,"precipitation":null},"wind":{"velocity_min":7,"velocity_max":17,"velocity_avg":11,"gust_max":null,"direction_degrees":135,"direction":"SE"},"thermal_sensation":{"max":32.3,"min":18.3},"text_icon":{"icon":{"dawn":"2","morning":"2","afternoon":"2","night":"2","day":"2"},"text":{"pt":"Sol com algumas nuvens","en":"Mostly sunny.","es":"Sol con algunas nubes. No llueve.","phrase":{"reduced":"Sol com algumas nuvens. N\u00e3o chove.","morning":"Sol com algumas nuvens","afternoon":"Sol com algumas nuvens","night":"Algumas nuvens","dawn":"Algumas nuvens"}}},"temperature":{"min":17,"max":27,"morning":{"min":17,"max":21},"afternoon":{"min":23,"max":27},"night":{"min":18,"max":25}}},{"date":"2017-12-11","date_br":"11/12/2017","humidity":{"min":40,"max":100},"rain":{"probability":null,"precipitation":null},"wind":{"velocity_min":6,"velocity_max":17,"velocity_avg":11,"gust_max":null,"direction_degrees":132,"direction":"SE"},"thermal_sensation":{"max":31.3,"min":15.9},"text_icon":{"icon":{"dawn":"2","morning":"2","afternoon":"2","night":"2","day":"2"},"text":{"pt":"Sol com algumas nuvens","en":"Mostly sunny.","es":"Sol con algunas nubes. No llueve.","phrase":{"reduced":"Sol com algumas nuvens. N\u00e3o chove.","morning":"Sol com algumas nuvens","afternoon":"Sol com algumas nuvens","night":"Algumas nuvens","dawn":"Algumas nuvens"}}},"temperature":{"min":15,"max":28,"morning":{"min":15,"max":17},"afternoon":{"min":22,"max":28},"night":{"min":18,"max":26}}},{"date":"2017-12-12","date_br":"12/12/2017","humidity":{"min":28,"max":98},"rain":{"probability":null,"precipitation":null},"wind":{"velocity_min":2,"velocity_max":14,"velocity_avg":8,"gust_max":null,"direction_degrees":124,"direction":"ESE"},"thermal_sensation":{"max":32.2,"min":14.5},"text_icon":{"icon":{"dawn":"2","morning":"2","afternoon":"2","night":"2","day":"2"},"text":{"pt":"Sol com algumas nuvens","en":"Mostly sunny.","es":"Sol con algunas nubes. No llueve.","phrase":{"reduced":"Sol com algumas nuvens. N\u00e3o chove.","morning":"Sol com algumas nuvens","afternoon":"Sol com algumas nuvens","night":"Algumas nuvens","dawn":"Algumas nuvens"}}},"temperature":{"min":13,"max":31,"morning":{"min":13,"max":22},"afternoon":{"min":25,"max":31},"night":{"min":20,"max":29}}},{"date":"2017-12-13","date_br":"13/12/2017","humidity":{"min":29,"max":100},"rain":{"probability":null,"precipitation":null},"wind":{"velocity_min":3,"velocity_max":18,"velocity_avg":9,"gust_max":null,"direction_degrees":132,"direction":"SE"},"thermal_sensation":{"max":31.3,"min":16.8},"text_icon":{"icon":{"dawn":"2","morning":"2","afternoon":"2","night":"2","day":"2"},"text":{"pt":"Sol com algumas nuvens","en":"Mostly sunny.","es":"Sol con algunas nubes. No llueve.","phrase":{"reduced":"Sol com algumas nuvens. N\u00e3o chove.","morning":"Sol com algumas nuvens","afternoon":"Sol com algumas nuvens","night":"Algumas nuvens","dawn":"Algumas nuvens"}}},"temperature":{"min":15,"max":30,"morning":{"min":15,"max":21},"afternoon":{"min":25,"max":30},"night":{"min":18,"max":27}}},{"date":"2017-12-14","date_br":"14/12/2017","humidity":{"min":33,"max":95},"rain":{"probability":null,"precipitation":null},"wind":{"velocity_min":10,"velocity_max":16,"velocity_avg":13,"gust_max":null,"direction_degrees":119,"direction":"ESE"},"thermal_sensation":{"max":31.4,"min":14.8},"text_icon":{"icon":{"dawn":"2","morning":"2","afternoon":"2","night":"2","day":"2"},"text":{"pt":"Sol com algumas nuvens","en":"Mostly sunny.","es":"Sol con algunas nubes. No llueve.","phrase":{"reduced":"Sol com algumas nuvens. N\u00e3o chove.","morning":"Sol com algumas nuvens","afternoon":"Sol com algumas nuvens","night":"Algumas nuvens","dawn":"Algumas nuvens"}}},"temperature":{"min":14,"max":29,"morning":{"min":14,"max":21},"afternoon":{"min":23,"max":29},"night":{"min":20,"max":28}}},{"date":"2017-12-15","date_br":"15/12/2017","humidity":{"min":46,"max":91},"rain":{"probability":60,"precipitation":12},"wind":{"velocity_min":7,"velocity_max":12,"velocity_avg":9,"gust_max":null,"direction_degrees":74,"direction":"ENE"},"thermal_sensation":{"max":33,"min":19.8},"text_icon":{"icon":{"dawn":"4","morning":"4","afternoon":"2","night":"4","day":"4"},"text":{"pt":"Sol e Chuva","en":"Sun and rain.","es":"Sol y aumento de nubes. Chubascos aislados en la tarde y en la noche.","phrase":{"reduced":"Sol o dia todo. Muitas nuvens e pancadas de chuva de manh\u00e3 e \u00e0 noite.","morning":"Sol e Chuva","afternoon":"Sol com algumas nuvens","night":"Algumas nuvens e chuva","dawn":"Algumas nuvens e chuva"}}},"temperature":{"min":18,"max":29,"morning":{"min":18,"max":21},"afternoon":{"min":23,"max":29},"night":{"min":22,"max":27}}},{"date":"2017-12-16","date_br":"16/12/2017","humidity":{"min":47,"max":88},"rain":{"probability":75,"precipitation":12},"wind":{"velocity_min":3,"velocity_max":10,"velocity_avg":6,"gust_max":null,"direction_degrees":55,"direction":"NE"},"thermal_sensation":{"max":37.2,"min":23.1},"text_icon":{"icon":{"dawn":"2","morning":"2","afternoon":"4","night":"4","day":"4"},"text":{"pt":"Sol e Chuva","en":"Sun and rain.","es":"Sol y aumento de nubes. Chubascos aislados en la tarde y en la noche.","phrase":{"reduced":"Sol e aumento de nuvens de manh\u00e3. Pancadas de chuva \u00e0 tarde e \u00e0 noite.","morning":"Sol com algumas nuvens","afternoon":"Sol e Chuva","night":"Algumas nuvens e chuva","dawn":"Algumas nuvens"}}},"temperature":{"min":20,"max":31,"morning":{"min":20,"max":24},"afternoon":{"min":25,"max":31},"night":{"min":25,"max":30}}}]}';
        //$httpCode = 200;

        if ($httpCode != 200) {
            throw new \Exception($this->readErrorMessage($content), 1);            
        }

        return new Forecast(json_decode($content), 'AdinanCenci\Climatempo\FifteenDays');        
    }

    public function seventyTwoHours($cityId) 
    {
        $url        = 'http://apiadvisor.climatempo.com.br/api/v1/forecast/locale/'.$cityId.'/hours/72?token='.$this->token;
        $content    = $this->request($url, 'get', $httpCode);

        if ($httpCode != 200) {
            throw new \Exception($this->readErrorMessage($content), 1);            
        }

        return new Forecast(json_decode($content), 'AdinanCenci\Climatempo\SeventyTwoHours');
    }

    public function current($cityId) 
    {
        $url        = 'http://apiadvisor.climatempo.com.br/api/v1/weather/locale/'.$cityId.'/current?token='.$this->token;
        $content    = $this->request($url, 'get', $httpCode);

        if ($httpCode != 200) {
            throw new \Exception($this->readErrorMessage($content), 1);            
        }

        return new Weather(json_decode($content));
    }

    public function getCityById($cityId) 
    {
        $url        = 'http://apiadvisor.climatempo.com.br/api/v1/locale/city/'.$cityId.'?token='.$this->token;
        $content    = $this->request($url, 'get', $httpCode);

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

        $content = $this->request($url, 'get', $httpCode);

        if ($httpCode != 200) {
            throw new \Exception($this->readErrorMessage($content), 1);            
        }

        return json_decode($content, true);
    }

    /**
     * @param string $url
     * @param string $method
     * @param int $httpCode Will return the request code
     * @return string
     */
    protected function request($url, $method = 'get', &$httpCode) 
    {
        $ch         = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
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
