<?php
class CountryListLoader {

	static function Get(){
		$LANG = getenv("LANG"); // "cs_CZ.UTF-8"
		$LANG = preg_replace('/\..+/','',$LANG); // "cs_CZ.UTF-8" -> "cs_CZ"

		$vendor_dirs = [
			__DIR__ . "/../../../vendor", // in development & production
			__DIR__ . "/../../vendor" // while testing this package
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

		return $countries;
	}
}
