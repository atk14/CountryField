<?php
class CountryListLoader {

	static function Get($options = array()){
		$options += array(
			"add_extra_countries" => array(), // ["IC" => "Canary Islands", "NV" => "Neverland"]
		);

		$LANG = getenv("LANG"); // "cs_CZ.UTF-8"
		$LANG = preg_replace('/\..+/','',$LANG); // "cs_CZ.UTF-8" -> "cs_CZ"
		$lng = preg_replace('/_.*$/','',$LANG); // "cs_CZ" -> "cs"

		$vendor_dirs = [
			__DIR__ . "/../../vendor", // while testing this package
			__DIR__ . "/../../../../../vendor", // in development & production
		];

		foreach($vendor_dirs as $vendor){
			$data_file = "$vendor/umpirsky/country-list/data/$LANG/country.php";
			if(!file_exists($data_file)){
				$data_file = "$vendor/umpirsky/country-list/data/en/country.php";
			}
			if(file_exists($data_file)){
				break;
			}
		}
		
		if(!file_exists($data_file)){
			throw new Exception("Required file not found: $data_file. Please run composer require umpirsky/country-list");
		}
		
		$countries = require($data_file);

		foreach($options["add_extra_countries"] as $code => $country_name){
			if(!isset($countries[$code])){
				$countries[$code] = $country_name;
			}
		}

		$replaces = array(
			"cs" => array(
				"CZ" => "Česká republika",
				"GB" => "Velká Británie",
				"MK" => "Makedonie",
				"US" => "Spojené státy americké",
			),
			"sk" => array(
				"CZ" => "Česká republika",
				"GB" => "Veľká Británia",
				"US" => "Spojené štáty americké",
			),
			"en" => array(
				"CZ" => "Czech Republic" ,
				"US" => "United States of America",
			),
		);

		if(isset($replaces[$lng])){
			foreach($replaces[$lng] as $code => $country_name){
				$countries[$code] = $country_name;
			}
		}

		if(isset($replaces[$lng]) || $options["add_extra_countries"]){
			if(defined("SORT_LOCALE_STRING")){
				asort($countries,constant("SORT_LOCALE_STRING"));
			}
		}

		return $countries;
	}
}
