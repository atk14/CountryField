<?php
class TcToCountryName extends TcBase {

	function test(){
		putenv("LANG=cs_CZ.UTF-8");
		$this->assertEquals("Česká republika",smarty_modifier_to_country_name("CZ"));
		$this->assertEquals("Spojené státy",smarty_modifier_to_country_name("US"));
		$this->assertEquals("XX",smarty_modifier_to_country_name("XX"));

		putenv("LANG=en_US.UTF-8");
		$this->assertEquals("Czech Republic",smarty_modifier_to_country_name("CZ"));
		$this->assertEquals("United States",smarty_modifier_to_country_name("US"));
		$this->assertEquals("XX",smarty_modifier_to_country_name("XX"));
	}
}
