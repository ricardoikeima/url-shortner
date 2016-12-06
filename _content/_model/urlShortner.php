<?php
/* 
 * Created by: Ricardo Satoshi Ikeima 
 * Date: 02 December 2016
 * URL Shortner - Bluefin Enterprises - Coding Challenge
**/

	class UrlShortner {
		private $url;
		private $key;

		public function __construct($key, $url){
			$this->url = $url;
			$this->key = $key;
		}

		public function getUrl(){
			return $this->url;
		}

		public function getKey(){
			return $this->key;
		}

		public function setUrl($url){
			$this->url;
		}

		public function setKey($key){
			$this->key;
		}
	}
?>