<?php
/**
 * Displays country name according to its code ISO
 *
 *	{$cc} --> CZ
 *	{$cc|to_country_name} --> Česká republika
 */
function smarty_modifier_to_country_name($code) {
	$countries = CountryListLoader::Get();
	return isset($countries[$code]) ? $countries[$code] : $code;
}
