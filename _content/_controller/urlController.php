<?php
/* 
 * Created by: Ricardo Satoshi Ikeima 
 * Date: 02 December 2016
 * URL Shortner - Bluefin Enterprises - Coding Challenge
**/

	include_once ('../../_admin/config.php');


	$urlShortnerDb = new UrlShortnerDb($db);
	$urlVisitDb = new UrlVisitDb($db);

	if (isset($_POST['url'])) {
		$url = $_POST['url'];

		// If URL is valid
		// Code snipped from: http://stackoverflow.com/questions/7003416/validating-a-url-in-php
		if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
			// Verify if the URL is new
			// If true it will create a random key and store the key/URL into the database
			// if false it will return the key for this URL 
			if ($urlShortnerDb->isUrlNew($url)) {
				$key = createKey($urlShortnerDb);

				$urlShortner = new UrlShortner($key, $url);
				$urlShortnerDb->setUrlShortner($urlShortner);
			} else {
				$key = $urlShortnerDb->getKey($url);
			}

			$link = $_SERVER['HTTP_HOST'].'/'.$key;
			echo '<a href="//'. $link .'" target="_blank">'. $link .'  </a>';

		} else {
			// If URL is Invalid, return a message
			echo '<p> Invalid URL (e.g.: http://www.example.com) </p>';
			return;
		}
	}

	// Open the link
	if (isset($_GET['key'])) {
		$key = $_GET['key'];
		$userPlace = new UserPlace();
		$country = $userPlace->getCountry();
		$city = $userPlace->getCity();

		// Verify if Key is Valid 
		if ($urlShortnerDb->isKeyAssigned($key)){
			$urlVisitDb->setVisit($key, $country, $city);

			// Get URL
			$url = $urlShortnerDb->getUrl($key);

			//$link = curl_init($url);
			//curl_exec($link);
			header('Location:'.$url);
		}

	}

	// Function to create a unique random key
	function createKey($urlShortnerDb){
		do {
			$key = "";
			while (strlen($key) < KEYSIZE){
				// Create a random number, from 0 to 36
				// Covert the number from base 10 to base 36
				$key .= base_convert((string)rand(0, 36), 10, 36);
			}
		} while ($urlShortnerDb->isKeyAssigned($key));
		
		return $key;
	}
?>