<?php
class CountryField extends ChoiceField {

	function __construct($options = array()){

		$choices = [
			"" => "",
		];

		foreach(CountryListLoader::Get() as $code => $name){
			$choices[$code] = $name;
		}
		
		$options += [
			"choices" => $choices,
		];

		parent::__construct($options);
	}
}
