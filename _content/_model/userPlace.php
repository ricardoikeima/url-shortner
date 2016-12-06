<?php
/* Code snipped from:
 * http://stackoverflow.com/questions/12553160/getting-visitors-country-from-their-ip
 * Date: 01 December 2016
 * Modified by: Ricardo Satoshi Ikeima (01 December 2016)
 * URL Shortner - Bluefin Enterprises - Coding Challenge
**/

    class UserPlace {
        private $country;
        private $city;

        public function __construct() {

            $client  = @$_SERVER['HTTP_CLIENT_IP'];
            $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
            $remote  = $_SERVER['REMOTE_ADDR'];
            $country  = "Unknown";
            $city  = "Unknown";

            if(filter_var($client, FILTER_VALIDATE_IP))
            {
                $ip = $client;
            }
            elseif(filter_var($forward, FILTER_VALIDATE_IP))
            {
                $ip = $forward;
            }
            else
            {
                $ip = $remote;
            }
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://www.geoplugin.net/json.gp?ip=".$ip);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $ip_data_in = curl_exec($ch); // string
            curl_close($ch);

            $ip_data = json_decode($ip_data_in,true);
            $ip_data = str_replace('&quot;', '"', $ip_data); // for PHP 5.2 see stackoverflow.com/questions/3110487/

            if($ip_data && $ip_data['geoplugin_countryName'] != null) {
                $country = $ip_data['geoplugin_countryName'];
                $city = $ip_data['geoplugin_city'];
            }

            $this->country = $country;
            $this->city = $city;
        }

        public function getCountry(){
            return $this->country;
        }

        public function getCity(){
            return $this->city;
        }
    }
?>