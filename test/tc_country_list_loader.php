<?php
class TcCountryListLoader extends TcBase {

	function test(){
		putenv("LANG=cs_CZ.UTF-8");
		$list = CountryListLoader::Get();
		$this->assertEquals("Slovensko",$list["SK"]);
		$this->assertEquals("Spojené státy",$list["US"]);

		putenv("LANG=en_US.UTF-8");
		$list = CountryListLoader::Get();
		$this->assertEquals("Slovakia",$list["SK"]);
		$this->assertEquals("United States",$list["US"]);
	}
}
