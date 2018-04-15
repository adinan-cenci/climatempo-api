<?php

require __DIR__.'/Reflections.php';

use \AdinanCenci\Climatempo\Climatempo;

class HttpRequests extends Reflections
{
    public function testGetRequest() 
    {
        $ct = new Climatempo('my-token');

        $expected   = 'Climatempo';
        $url        = 'http://httpbin.org/get?my-project-name='.$expected;
        $content    = $this->invokeProtectedMethod($ct, 'request', [$url, null, 'get']); 
        $json       = json_decode($content, true);

        $this->assertEquals($json['args']['my-project-name'], $expected);
    }

    public function testPostRequest() 
    {
        $ct = new Climatempo('my-token');

        $expected   = 'Climatempo';
        $url        = 'http://httpbin.org/post';
        $content    = $this->invokeProtectedMethod($ct, 'request', [$url, 'my-project-name='.$expected, 'post']); 
        $json       = json_decode($content, true);

        $this->assertEquals($json['form']['my-project-name'], $expected);
    }
}
