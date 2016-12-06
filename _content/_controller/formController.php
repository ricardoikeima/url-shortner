<?php
/* 
 * Created by: Ricardo Satoshi Ikeima 
 * Date: 02 December 2016
 * URL Shortner - Bluefin Enterprises - Coding Challenge
**/

	include_once ('../../_admin/config.php');

	$urlShortnerDb = new UrlShortnerDb($db);
	$urlVisitDb = new UrlVisitDb($db);

	// Populate Cities according to the Country selected	
	if (isset($_POST['country'])) {
		if ($_POST['country'] != 'All') {
			$country = $_POST['country'];
			$citites = $urlVisitDb->getAllCitiesFromCountry($country);
			echo '<option> All </option>';

			foreach ($citites as $city) {
				echo '<option>' . $city['city'] . '</option>';
			}
		} else {
			echo '<option> All </option>';
		}
	} else {
		// Show only 'All' if no Country is selected
		$countries = $urlVisitDb->getAllCountries();
			
	    echo 'Country: ';
		echo '<select id="country" name="country" onchange="updateCity(document.getElementById(' . "'country'" . ').value)">';

		echo '<option> All </option>';

		foreach ($countries as $country) {
			echo '<option>' . $country['country'] . '</option>';
		}
	    echo '</select>';
	    echo '  City: ';
		echo '<select id="city" name="city">';
		echo '<option> All </option>';
		echo '</select>';
	}

?>