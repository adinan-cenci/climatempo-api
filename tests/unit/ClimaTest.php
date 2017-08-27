<?php

require __DIR__.'/Reflections.php';

use \AdinanCenci\Climatempo\Climatempo;

class ClimaTest extends Reflections
{
	public function testConvertStringIntoTimestamp() 
	{
		date_default_timezone_set('America/Sao_Paulo');

		$expected 	= mktime(0, 0, 0, 1, 1);

		$scraper 	= new Climatempo(1);
		$timestamp 	= $this->invokeProtectedMethod($scraper, 'sanitizeDate', array(
			'date' => '01/01'
		));

		$this->assertEquals($timestamp, $expected);
	}
}