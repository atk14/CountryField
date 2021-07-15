<?php
class TcCountryField extends TcBase {

	function test(){
		$this->field = new CountryField();

		$value = $this->assertValid("CZ");
		$this->assertEquals("CZ",$value);

		$value = $this->assertValid("PL");
		$this->assertEquals("PL",$value);

		$err_message = $this->assertInvalid("XX");
		$this->assertEquals("Select a valid choice. That choice is not one of the available choices.",$err_message);

		// allowed_countries
		$this->field = new CountryField(array("allowed_countries" => array("CZ","SK")));

		$value = $this->assertValid("CZ");
		$this->assertEquals("CZ",$value);

		$err_message = $this->assertInvalid("PL");
		$this->assertEquals("Select a valid choice. That choice is not one of the available choices.",$err_message);

		// disallowed_countries

		$field = new CountryField(array("allowed_countries" => array("CZ","SK","PL","HU"), "disallowed_countries" => array("HU","DE")));

		$choices = $field->get_choices();
		$this->assertEquals(array("","CZ","PL","SK"),array_keys($choices));
	}

	function test_allowed_countries(){
		$field = new CountryField(array("allowed_countries" => array("SK","PL","CZ","HU")));
		$this->assertEquals(array("","CZ","HU","PL","SK"),array_keys($field->get_choices()));
	}

	function test_include_empty_choice(){
		$field = new CountryField(array(
			"include_empty_choice" => false,
			"allowed_countries" => array("SK","PL","CZ","HU")
		));
		$this->assertEquals(array("CZ","HU","PL","SK"),array_keys($field->get_choices()));
	}
}
