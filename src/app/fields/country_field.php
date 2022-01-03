<?php
class CountryField extends ChoiceField {

	function __construct($options = array()){
		$options += array(
			"allowed_countries" => null, // ["CZ","SK","PL","HU"] or "CZ,SK,PL,HU"
			"disallowed_countries" => null, // ["CZ","SK","PL","HU"] or "CZ,SK,PL,HU"
			"include_empty_choice" => true,
			"empty_choice_text" => "", // e.g. "-- country --"
		);

		$allowed_countries = $options["allowed_countries"];
		if(!is_null($allowed_countries) && !is_array($allowed_countries)){
			$allowed_countries = explode(",",$allowed_countries);
		}

		$disallowed_countries = $options["disallowed_countries"];
		if(!is_null($disallowed_countries) && !is_array($disallowed_countries)){
			$disallowed_countries = explode(",",$disallowed_countries);
		}

		$choices = array();
		if($options["include_empty_choice"]){
			$choices[""] = $options["empty_choice_text"];
		}
		foreach(CountryListLoader::Get() as $code => $name){
			if($allowed_countries && !in_array($code,$allowed_countries)){
				continue;
			}
			if($disallowed_countries && in_array($code,$disallowed_countries)){
				continue;
			}
			$choices[$code] = $name;
		}
		
		$options["choices"] = $choices;

		parent::__construct($options);
	}
}
