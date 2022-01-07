<?php
class TcCountryListLoader extends TcBase {

	function test(){
		putenv("LANG=cs_CZ.UTF-8");
		$list = CountryListLoader::Get();
		$this->assertEquals("Slovensko",$list["SK"]);
		$this->assertEquals("Spojené státy americké",$list["US"]);

		putenv("LANG=en_US.UTF-8");
		$list = CountryListLoader::Get();
		$this->assertEquals("Slovakia",$list["SK"]);
		$this->assertEquals("United States of America",$list["US"]);
	}

	function test_extra_countries(){
		$list = CountryListLoader::Get();
		$orig_size = sizeof($list);
		$this->assertTrue($orig_size>100);
		$this->assertTrue(!isset($list["NV"]));
		$this->assertTrue(!isset($list["XL"]));

		$list = CountryListLoader::Get(array("add_extra_countries" => array(
			"NV" => "Neverland",
			"XL" => "Legendary Islands"
		)));
		$this->assertEquals($orig_size+2,sizeof($list));
		$this->assertEquals("Neverland",$list["NV"]);
		$this->assertEquals("Legendary Islands",$list["XL"]);
	}
}
