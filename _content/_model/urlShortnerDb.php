<?php
/* 
 * Created by: Ricardo Satoshi Ikeima 
 * Date: 02 December 2016
 * URL Shortner - Bluefin Enterprises - Coding Challenge
**/

	class UrlShortnerDb {

		private $urlShortner;
		private $db;

		public function __construct(PDO $db){
			$this->db = $db;
		}

		// Verify if URL already exist
		// Return true if it exists, false otherwise
		public function isUrlNew($url){
			$sql = "SELECT `url`
					FROM `urlshortner` 
					WHERE `url` 
					LIKE :url";
			$query = $this->db->prepare( $sql );
			$query->execute(array(':url'=>$url));
			$containUrl= $query->fetchAll( PDO::FETCH_ASSOC );

			if (sizeof($containUrl) > 0){
				return FALSE;
			}
			
			return TRUE;
		}

		// Verify if Key already exist
		// Return true if it exists, false otherwise
		public function isKeyAssigned($key){
			$sql = "SELECT `key`
					FROM `urlshortner` 
					WHERE `key` 
					LIKE :key";
			$query = $this->db->prepare( $sql );
			$query->execute(array(':key'=>$key));
			$containKey= $query->fetchAll( PDO::FETCH_ASSOC );
		
			if (sizeof($containKey) == 0){
				return FALSE;
			}
			
			return TRUE;
		}

		// Set urlShortner
		public function setUrlShortner(UrlShortner $urlShortner){
			$this->urlShortner = $urlShortner;
			$key = $this->urlShortner->getKey();
			$url = $this->urlShortner->getUrl();

			$sql = "INSERT INTO `urlshortner` (`key`, `url`)
					VALUES (:key, :url)";
			$insert = $this->db->prepare( $sql );
			$insert->execute(array(':key'=>$key,
									':url'=>$url));
		}

		// Get URL from key
		public function getUrl($key){
			$sql = "SELECT `key`, `url`
					FROM `urlshortner` 
					WHERE `key` 
					LIKE :key";
			$query = $this->db->prepare( $sql );
			$query->execute(array(':key'=>$key));
			$url= $query->fetch( PDO::FETCH_ASSOC );

			return $url['url'];
		}

		// Get key from URL
		public function getKey($url){
			$sql = "SELECT `key`, `url`
					FROM `urlshortner` 
					WHERE `url` 
					LIKE :url";
			$query = $this->db->prepare( $sql );
			$query->execute(array(':url'=>$url));
			$key= $query->fetch( PDO::FETCH_ASSOC );

			return $key['key']; 
		}

		// Get all key from URL
		public function getAllUrlShortner(){
			$sql = "SELECT *
					FROM `urlshortner`";
			$query = $this->db->prepare( $sql );
			$query->execute();
			$allUrlShortner= $query->fetchAll( PDO::FETCH_ASSOC );

			$all = array();

			foreach ($allUrlShortner as $keyUrl) {
				$key = $keyUrl['key'];
				$url = $keyUrl['url'];

				$urlShortner = new UrlShortner($key, $url);
				array_push($all, $urlShortner);
			}
			

			return $all; 
		}
	}
?>