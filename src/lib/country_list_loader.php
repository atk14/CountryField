<?php
class CountryListLoader {

	static function Get($options = array()){
		$options += array(
			"add_extra_countries" => array(), // ["IC" => "Canary Islands", "NV" => "Neverland"],
			"lang" => null, // "cs", "en", "sr", "sr_Cyrl", "sr_Latn" (see vendor/umpirsky/country-list/data - )
		);

		$LANG = getenv("LANG"); // "cs_CZ.UTF-8"
		$LANG = preg_replace('/\..+/','',$LANG); // "cs_CZ.UTF-8" -> "cs_CZ"
		$lng = preg_replace('/_.*$/','',$LANG); // "cs_CZ" -> "cs"

		$langs = array();
		if($options["lang"]){
			$langs[] = $options["lang"];
			$langs[] = preg_replace('/^(..).*/','\1',$options["lang"]);
		}
		$langs[] = $LANG; // e.g. "cs_CZ"
		$langs[] = $lng; // e.g. "cs"
		$langs[] = "en"; // fallback

		// little sanitization
		$langs = array_filter($langs,function($l){
			return (bool)preg_match('/^[a-zA-Z_]{2,30}$/',$l);
		});

		$vendor_dirs = [
			__DIR__ . "/../../vendor", // while testing this package
			__DIR__ . "/../../../../../vendor", // in development & production
		];

		foreach($vendor_dirs as $vendor){
			foreach($langs as $l){
				$data_file = "$vendor/umpirsky/country-list/data/$l/country.php";
				if(file_exists($data_file)){
					break(2);
				}
			}
		}
		
		if(!file_exists($data_file)){
			throw new Exception("Required file not found: $data_file. Please run composer require umpirsky/country-list");
		}

		$countries = require($data_file);

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
			"hu" => array(
				"US" => "Amerikai Egyesült Államok", // it was "Egyesült Államok"
			),
		);

		if(isset($replaces[$lng])){
			foreach($replaces[$lng] as $code => $country_name){
				$countries[$code] = $country_name;
			}
		}

		foreach($options["add_extra_countries"] as $code => $country_name){
			// Note that an extra country may replace existing entry.
			$countries[$code] = $country_name;
		}

		if(isset($replaces[$lng]) || $options["add_extra_countries"]){
			if(defined("SORT_LOCALE_STRING")){
				asort($countries,constant("SORT_LOCALE_STRING"));
			}
		}

		return $countries;
	}
}
