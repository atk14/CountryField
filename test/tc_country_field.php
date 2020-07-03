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
	}
}
