<?php

/* 
 * just a cache thing, cache is always a good thing
*/

function getCacheName($citiesIds) 
{
	return 'climatempo-'.implode('-', $citiesIds).'.txt';
}

function getCache($citiesIds, $timeToLive = 3000/*seconds*/) 
{
	$citiesIds = is_array($citiesIds) ? $citiesIds : array($citiesIds);

	$cacheFileName = getCacheName($citiesIds);

	if(!file_exists($cacheFileName)) {
		return null;
	} else {
		$lastTimeModified = filemtime($cacheFileName);
		if((time() - $lastTimeModified) > $timeToLive) {
			return null;
		} else {
			return json_decode(file_get_contents($cacheFileName), true);
		}
	}
}

function setCache($citiesIds, $content) 
{
	$citiesIds = is_array($citiesIds) ? $citiesIds : array($citiesIds);

	$cacheFileName = getCacheName($citiesIds);

	$content = json_encode($content);
	$fp = fopen($cacheFileName, 'w');
	fwrite($fp, $content);
	fclose($fp);
}