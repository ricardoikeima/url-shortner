<?php
/* 
 * Created by: Ricardo Satoshi Ikeima 
 * Date: 02 December 2016
 * URL Shortner - Bluefin Enterprises - Coding Challenge
**/

	include_once ('../../_admin/config.php');

	$urlShortnerDb = new UrlShortnerDb($db);
	$urlVisitDb = new UrlVisitDb($db);

	$urlShortnerList = $urlShortnerDb->getAllUrlShortner();

	echo '<table><tr>';
	echo '<th> URL</th>';
	echo '<th> Short URL</th>';
	echo '</tr>';

	// Get all URL
	foreach ($urlShortnerList as $urlShortner) {
		echo '<tr>';
		$key = $urlShortner->getKey();
		$url = $urlShortner->getUrl();
		$keyLink = $_SERVER['HTTP_HOST'].'/'. $key;
		echo '<td>'. $url . '</td>';
		echo '<td><a href="//'. $keyLink . '" target="_blank">'. $keyLink .'</td>';
		echo '</tr>';
	}
	echo '</table>';
?>