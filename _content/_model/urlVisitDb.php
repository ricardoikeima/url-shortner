<?php
/* 
 * Created by: Ricardo Satoshi Ikeima 
 * Date: 02 December 2016
 * URL Shortner - Bluefin Enterprises - Coding Challenge
**/

	class UrlVisitDb {

		private $urlShortner;
		private $db;

		public function __construct(PDO $db){
			$this->db = $db;
		}

		// Set Visit
		public function setVisit($key, $country, $city){
			$sql = "INSERT INTO `visitcounter` (`key`, `date`, `country`, `city`)
					VALUES (:key, :todayDate, :country, :city)";
			$insert = $this->db->prepare( $sql );
			$insert->execute(array(':key'=>$key,
									':todayDate'=>date("Y-m-d"),
									':country'=>$country,
									':city'=>$city));
		}

		// Get Total Visit
		public function getTotalVisit($key){
			$sql = "SELECT COUNT(`visitId`)
					FROM `visitcounter` 
					WHERE `key` 
					LIKE :key";
			$query = $this->db->prepare( $sql );
			$query->execute(array(':key'=>$key));
			$count= $query->fetch( PDO::FETCH_COLUMN );
			
			return $count;
		}

		// Get Total Visit Period
		public function getTotalVisitPeriod($key, $startDate, $endDate){
			$sql = "SELECT COUNT(`visitId`)
					FROM `visitcounter` 
					WHERE `key` 
					LIKE :key 
					AND	(`date`
					>= :startDate
					AND `date`
					<= :endDate)";
			$query = $this->db->prepare( $sql );
			$query->execute(array(':key'=>$key,
								  ':startDate'=>$startDate,
								  ':endDate'=>$endDate));
			$count= $query->fetch( PDO::FETCH_COLUMN );
			
			return $count;
		}

		// Get Visit from period
		public function getVisitFromDate($key, $startDate, $endDate){
			$sql = "SELECT COUNT(`visitId`)
					FROM `visitcounter` 
					WHERE `key` 
					LIKE :key 
					AND	(`date`
					>= :startDate
					AND `date`
					<= :endDate)";
			$query = $this->db->prepare( $sql );
			$query->execute(array(':key'=>$key,
								  ':startDate'=>$startDate,
								  ':endDate'=>$endDate));
			$count= $query->fetch( PDO::FETCH_COLUMN );
			
			return $count;
		}

		// Get Country
		public function getCountry($key){
			$sql = "SELECT DISTINCT `country`
					FROM `visitcounter` 
					WHERE `key` 
					LIKE :key";
			$query = $this->db->prepare( $sql );
			$query->execute(array(':key'=>$key));
			$country= $query->fetchAll( PDO::FETCH_ASSOC );
			
			return $country;
		}

		// Get All Countries
		public function getAllCountries(){
			$sql = "SELECT DISTINCT `country`
					FROM `visitcounter`
					ORDER BY `country`";
			$query = $this->db->prepare( $sql );
			$query->execute(array());
			$country= $query->fetchAll( PDO::FETCH_ASSOC );
			
			return $country;
		}

		// Get All Cities
		public function getAllCitiesFromCountry($country){
			$sql = "SELECT DISTINCT `city`
					FROM `visitcounter`
					WHERE `country` 
					LIKE :country
					ORDER BY `city`";
			$query = $this->db->prepare( $sql );
			$query->execute(array(':country'=>$country));
			$country= $query->fetchAll( PDO::FETCH_ASSOC );
			
			return $country;
		}

		// Get City From Country
		public function getCityFromCountry($key, $country){
			$sql = "SELECT DISTINCT `city`
					FROM `visitcounter` 
					WHERE `key` 
					LIKE :key
					AND `country`
					LIKE :country";
			$query = $this->db->prepare( $sql );
			$query->execute(array(':key'=>$key,
								  ':country'=>$country));
			$city= $query->fetchAll( PDO::FETCH_ASSOC );
			
			return $city;
		}

		// Get City From Country
		public function getCityFromCountryPeriod($key, $country, $startDate, $endDate){
			$sql = "SELECT DISTINCT `city`
					FROM `visitcounter` 
					WHERE `key` 
					LIKE :key
					AND `country`
					LIKE :country
					AND	(`date`
					>= :startDate
					AND `date`
					<= :endDate)";
			$query = $this->db->prepare( $sql );
			$query->execute(array(':key'=>$key,
								  ':country'=>$country,
								  ':startDate'=>$startDate,
								  ':endDate'=>$endDate));
			$city= $query->fetchAll( PDO::FETCH_ASSOC );
			
			return $city;
		}

		// Get Total Visit From Country
		public function getVisitFromCountry($key, $country){
			$sql = "SELECT COUNT(`visitId`)
					FROM `visitcounter` 
					WHERE `key` 
					LIKE :key
					AND `country`
					LIKE :country";
			$query = $this->db->prepare( $sql );
			$query->execute(array(':key'=>$key,
								  ':country'=>$country));
			$count= $query->fetch( PDO::FETCH_COLUMN );

			return $count;
		}

		// Get Total Visit From Country
		public function getVisitFromCountryPeriod($key, $country, $startDate, $endDate){
			$sql = "SELECT COUNT(`visitId`)
					FROM `visitcounter` 
					WHERE `key` 
					LIKE :key
					AND `country`
					LIKE :country
					AND	(`date`
					>= :startDate
					AND `date`
					<= :endDate)";
			$query = $this->db->prepare( $sql );
			$query->execute(array(':key'=>$key,
								  ':country'=>$country,
								  ':startDate'=>$startDate,
								  ':endDate'=>$endDate));
			$count= $query->fetch( PDO::FETCH_COLUMN );

			return $count;
		}

		// Get Total Visit From City
		public function getVisitFromCity($key, $country, $city){
			$sql = "SELECT COUNT(`visitId`)
					FROM `visitcounter` 
					WHERE `key` 
					LIKE :key
					AND `country`
					LIKE :country
					AND `city`
					LIKE :city";
			$query = $this->db->prepare( $sql );
			$query->execute(array(':key'=>$key,
								  ':country'=>$country,
								  ':city'=>$city));
			$count= $query->fetch( PDO::FETCH_COLUMN );

			return $count;
		}

		// Get Total Visit From City From Period
		public function getVisitFromCitiesPeriod($key, $country, $city, $startDate, $endDate){
			$sql = "SELECT COUNT(`visitId`)
					FROM `visitcounter` 
					WHERE `key` 
					LIKE :key
					AND `country`
					LIKE :country
					AND `city`
					LIKE :city
					AND	(`date`
					>= :startDate
					AND `date`
					<= :endDate)";
			$query = $this->db->prepare( $sql );
			$query->execute(array(':key'=>$key,
								  ':country'=>$country,
								  ':city'=>$city,
								  ':startDate'=>$startDate,
								  ':endDate'=>$endDate));
			$count= $query->fetch( PDO::FETCH_COLUMN );

			return $count;
		}

		// Get Total Visit From City From Period
		public function getVisitFromCityFromPeriod($key, $country, $city, $startDate, $endDate){
			$sql = "SELECT COUNT(`visitId`)
					FROM `visitcounter` 
					WHERE `key` 
					LIKE :key
					AND `country`
					LIKE :country
					AND `city`
					LIKE :city					
					AND	(`date`
					>= :startDate
					AND `date`
					<= :endDate)";
			$query = $this->db->prepare( $sql );
			$query->execute(array(':key'=>$key,
								  ':country'=>$country,
								  ':city'=>$city,
								  ':startDate'=>$startDate,
								  ':endDate'=>$endDate));
			$count= $query->fetch( PDO::FETCH_COLUMN );

			return $count;
		}

	}
?>