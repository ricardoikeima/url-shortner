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
		echo '<th> Total Visits Period</th>';
		echo '<th> Visits by region</th>';
		echo '</tr>';

	if ( (($_POST['startDate'] != "") && ($_POST['endDate'] == "")) || 
	     (($_POST['startDate'] == "") && ($_POST['endDate'] != "")) ||
		  ($_POST['startDate'] > $_POST['endDate']) ) {
		
		echo '<p> Invalid dates </p>';
		return ;
	} else {
		// Get all URL
		foreach ($urlShortnerList as $urlShortner) {
			echo '<tr>';
			$key = $urlShortner->getKey();
			$url = $urlShortner->getUrl();

			echo '<td>'. $url . '</td>';

			// Total number of visit
			if ($_POST['startDate'] != "" && $_POST['endDate'] != ""){

				$startDate = $_POST['startDate']; 
				$endDate = $_POST['endDate'];
				$periodEntry = TRUE;

				$totalVisit = $urlVisitDb->getTotalVisitPeriod($key, $startDate, $endDate);

			} else {
				$periodEntry = FALSE;
				$totalVisit = $urlVisitDb->getTotalVisit($key);
				
			}
			echo '<td>'. $totalVisit . '</td>';
			echo '<td class="align-left">';
			// Get the selected country
			if (isset($_POST['country']) && $_POST['country'] != 'All') {
				$country = $_POST['country'];
				
				// Get selected City
				if (isset($_POST['city']) && $_POST['city'] != 'All'){
					$city = $_POST['city'];

					// If a period was selected
					if ($periodEntry){
						$totalVisitCountry = getCountryPeriod($urlVisitDb, $key, $country, $startDate, $endDate, $totalVisit);

						getCityPeriod($urlVisitDb, $key, $city, $country, $startDate, $endDate, $totalVisitCountry);
					// If no period was selected
					} else {
						$totalVisitCountry = getCountry($urlVisitDb, $key, $country, $totalVisit);					

						getCity($urlVisitDb, $key, $city, $country, $totalVisitCountry);
					}
				// Get All Cities
				} else {
					$cityList = $urlVisitDb->getCityFromCountry($key, $country);

					// If a period was selected
					if ($periodEntry){			
						$totalVisitCountry = getCountryPeriod($urlVisitDb, $key, $country, $startDate, $endDate, $totalVisit);

						getAllCitiesPeriod($urlVisitDb, $key, $cityList, $country, $startDate, $endDate, $totalVisitCountry);
					// If no period was selected
					} else {
						$totalVisitCountry = getCountry($urlVisitDb, $key, $country, $totalVisit);

						getAllCities($urlVisitDb, $key, $cityList, $country, $totalVisitCountry);			
					}			
					
				}
			// Get All country for a key				
			} else {
				$countryList = $urlVisitDb->getCountry($key);

				if ($countryList){
					foreach ($countryList as $regionCountry) {
						$country = $regionCountry['country'];

						// If a period was selected
						if ($periodEntry){
							$cityList = $urlVisitDb->getCityFromCountryPeriod($key, $country, $startDate, $endDate);
							$totalVisitCountry = getCountryPeriod($urlVisitDb, $key, $country, $startDate, $endDate, $totalVisit);

							getAllCitiesPeriod($urlVisitDb, $key, $cityList, $country, $startDate, $endDate, $totalVisitCountry);
						// If no period was selected
						} else {
							$cityList = $urlVisitDb->getCityFromCountry($key, $country);
							$totalVisitCountry = getCountry($urlVisitDb, $key, $country, $totalVisit);					
							getAllCities($urlVisitDb, $key, $cityList, $country, $totalVisitCountry);
						}
					}

					echo '</td>';
				} else {
					echo 'No visits </td>';
					echo '<td> No visits </td>';
				}
			}

			echo '</tr>';
		}
		
		echo '</table>';
	}

	function getAllCities($urlVisitDb, $key, $cityList, $country, $totalVisitCountry) {
		if ($cityList){

			echo '<ul>';

			foreach ($cityList as $regionCity) {
				$city = $regionCity['city'];
				// Total number of visit from a country
				$totalVisitCity = $urlVisitDb->getVisitFromCity($key, $country, $city);

				if ($totalVisitCountry != 0) {
					$percentage = round((($totalVisitCity * 100)/$totalVisitCountry),2);

					echo '<li>'. $city . ': ' . $totalVisitCity . ' (' . $percentage . '%)</li>';

				} else {
					echo '<li>'. $city . ': ' . $totalVisitCity . ' (0%)</li>';		
				}

			}

			echo '</ul>';
		}
	}

	function getAllCitiesPeriod($urlVisitDb, $key, $cityList, $country, $startDate, $endDate, $totalVisitCountry) {
		if ($cityList){

			echo '<ul>';

			foreach ($cityList as $regionCity) {
				$city = $regionCity['city'];
				// Total number of visit from a country
				$totalVisitCityPeriod = $urlVisitDb->getVisitFromCityFromPeriod($key, $country, $city, $startDate, $endDate);

				if ($totalVisitCountry != 0) {
					$percentage = round((($totalVisitCityPeriod * 100)/$totalVisitCountry),2);

					echo '<li>'. $city . ': ' . $totalVisitCityPeriod . ' (' . $percentage . '%)</li>';

				} else {
					echo '<li>'. $city . ': ' . $totalVisitCityPeriod . ' (0%)</li>';		
				}

			}

			echo '</ul>';
		}
	}

	function getCity($urlVisitDb, $key, $city, $country,  $totalVisitCountry) {
		echo '<ul>';
			
		// Total number of visit from a city
		$totalVisitCity = $urlVisitDb->getVisitFromCity($key, $country, $city);

		if ($totalVisitCountry != 0) {
			$percentage = round((($totalVisitCity * 100)/$totalVisitCountry),2);

			echo '<li>'. $city . ': ' . $totalVisitCity . ' (' . $percentage . '%)</li>';
		} else {
			echo '<li>'. $city . ': ' . $totalVisitCity . ' (0%)</li>';			
		}

		echo '</ul>';
	}

	function getCityPeriod($urlVisitDb, $key, $city, $country, $startDate, $endDate, $totalVisitCountry) {
		echo '<ul>';
		// Total number of visit from a city
		$totalVisitCity = $urlVisitDb->getVisitFromCityFromPeriod($key, $country, $city, $startDate, $endDate);
		if ($totalVisitCountry != 0) {
			$percentage = round((($totalVisitCity * 100)/$totalVisitCountry),2);

			echo '<li>'. $city . ': ' . $totalVisitCity . ' (' . $percentage . '%)</li>';
		} else {
			echo '<li>'. $city . ': ' . $totalVisitCity . ' (0%)</li>';			
		}

		echo '</ul>';

		return $totalVisitCity;
	}

	function getCountry($urlVisitDb, $key, $country, $totalVisit) {
		$totalVisitCountry = $urlVisitDb->getVisitFromCountry($key, $country);
					
		if ($totalVisit != 0) {
			$percentage = round((($totalVisitCountry * 100)/$totalVisit),2);

			echo '<li>'. $country . ': ' . $totalVisitCountry . ' (' . $percentage . '%)</li>';

		} else {
			echo '<li>'. $country . ': ' . $totalVisitCountry . ' (0%)</li>';		
		}

		return $totalVisitCountry;
	}
	
	function getCountryPeriod($urlVisitDb, $key, $country, $startDate, $endDate, $totalVisit) {
		$totalVisitCountry = $urlVisitDb->getVisitFromCountryPeriod($key, $country, $startDate, $endDate);

		if ($totalVisit != 0) {
			$percentage = round((($totalVisitCountry * 100)/$totalVisit),2);

			echo '<li>'. $country . ': ' . $totalVisitCountry . ' (' . $percentage . '%)</li>';

		} else {
			echo '<li>'. $country . ': ' . $totalVisitCountry . ' (0%)</li>';		
		}

		return $totalVisitCountry;
	}
?>