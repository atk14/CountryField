<?php
class CountryField extends ChoiceField {

	function __construct($options = array()){
		$options += array(
			"allowed_countries" => null, // array("CZ","SK","PL","HU") "CZ,SK,PL,HU"
		);

		$allowed_countries = $options["allowed_countries"];
		if(!is_null($allowed_countries) && !is_array($allowed_countries)){
			$allowed_countries = explode(",",$allowed_countries);
		}

		$choices = array("" => "");
		foreach(CountryListLoader::Get() as $code => $name){
			if($allowed_countries && !in_array($code,$allowed_countries)){
				continue;
			}
			$choices[$code] = $name;
		}
		
		$options["choices"] = $choices;

		parent::__construct($options);
	}
}
