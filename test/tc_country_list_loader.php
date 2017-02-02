<?php
class TcCountryListLoader extends TcBase {

	function test(){
		putenv("LANG=cs_CZ.UTF-8");
		$list = CountryListLoader::Get();
		$this->assertEquals("Česká republika",$list["CZ"]);
		$this->assertEquals("Spojené státy",$list["US"]);

		putenv("LANG=en_US.UTF-8");
		$list = CountryListLoader::Get();
		$this->assertEquals("Czech Republic",$list["CZ"]);
		$this->assertEquals("United Kingdom",$list["GB"]);
	}
}
