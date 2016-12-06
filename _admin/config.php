<?php
/* 
 * Created by: Ricardo Satoshi Ikeima 
 * Date: 02 December 2016
 * URL Shortner - Bluefin Enterprises - Coding Challenge
**/

	session_start();

	// create a PDO (PHP Data Object)
	// specifies the db type, host, db name, character set, username and password
	$db = new PDO('mysql:host=localhost:8889;dbname=url_shortner_ricardo;charset=utf8', 'root', 'root');
	
	// sets error mode, which allows errors to be thrown, rather than silently ignored
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


	define('HOME', dirname(dirname(__FILE__)) . '/');
	define('ROOT', '/');
	define('KEYSIZE', 6);

	// Import
	include_once (HOME.'_content/_model/urlShortnerDb.php');
	include_once (HOME.'_content/_model/urlVisitDb.php');
	include_once (HOME.'_content/_model/urlShortner.php');
	include_once (HOME.'_content/_model/userPlace.php');
?>