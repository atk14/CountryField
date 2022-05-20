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
		$this->assertTrue(!isset($list["UA-43"]));

		$list = CountryListLoader::Get(array("add_extra_countries" => array(
			"NV" => "Neverland",
			"XL" => "Legendary Islands",
			"UA-43" => "Crimea"
		)));
		$this->assertEquals($orig_size+3,sizeof($list));
		$this->assertEquals("Neverland",$list["NV"]);
		$this->assertEquals("Legendary Islands",$list["XL"]);
		$this->assertEquals("Crimea",$list["UA-43"]);

		// Extra country replaces existing entry

		$list = CountryListLoader::Get();
		$this->assertEquals("Czech Republic",$list["CZ"]);

		$list = CountryListLoader::Get(array("add_extra_countries" => array("CZ" => "Czechia & Bohemia")));
		$this->assertEquals("Czechia & Bohemia",$list["CZ"]);
	}

	function test_lang(){
		$list = CountryListLoader::Get(array(
			"lang" => "sr_Cyrl",
		));
		$this->assertEquals("Грчка",$list["GR"]);

		$list = CountryListLoader::Get(array(
			"lang" => "sr_Latn",
		));
		$this->assertEquals("Grčka",$list["GR"]);

		$list = CountryListLoader::Get(array(
			"lang" => "sr_Nonsence",
		));
		$this->assertEquals("Грчка",$list["GR"]); // used "sr"

		$list = CountryListLoader::Get(array(
			"lang" => "xx_Nonsence",
		));
		$this->assertEquals("Greece",$list["GR"]); // used "en" (there is not xx_Nonsence nor xx language)

		$list = CountryListLoader::Get(array(
			"lang" => "../data/hu", // evil attempt, must not pass
		));
		$this->assertEquals("Greece",$list["GR"]);

	}
}
