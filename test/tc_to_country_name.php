<?php
class TcToCountryName extends TcBase {

	function test(){
		putenv("LANG=cs_CZ.UTF-8");
		$this->assertEquals("Slovensko",smarty_modifier_to_country_name("SK"));
		$this->assertEquals("Spojené státy",smarty_modifier_to_country_name("US"));
		$this->assertEquals("XX",smarty_modifier_to_country_name("XX"));

		putenv("LANG=en_US.UTF-8");
		$this->assertEquals("Slovakia",smarty_modifier_to_country_name("SK"));
		$this->assertEquals("United States",smarty_modifier_to_country_name("US"));
		$this->assertEquals("XX",smarty_modifier_to_country_name("XX"));
	}
}
