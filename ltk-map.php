<?php

if(!$argv[1]){
	print "Usage: php ltk-map.php [locales-to-map-filename]\n\n";
	print "Tip: add '-json' after the filename to only print out JSON\n";
	exit();
}

$lingotek_locales = [];

$lingotek_locales_tms = json_decode(file_get_contents('data/locales-tms.json'));
foreach($lingotek_locales_tms->entities as $locale_obj){
	$lingotek_locales[] = $locale_obj->properties->code;
}
sort($lingotek_locales);

$locales_filename = $argv[1];//ex. 'zendesk-locales.txt'
$details = !(strpos($argv[2], '-json')!==FALSE);//"json only"

$language_default_locales = (array)json_decode(file_get_contents('data/language-default-locales.json'));
$locales_to_map = explode("\n", file_get_contents($locales_filename));

$new_locale_map = array_fill_keys($locales_to_map,"");

// ### \\

function find_lingotek_locale($locale) {
	global $lingotek_locales;
	global $language_default_locales;
	$found_lingotek_locale = FALSE;

	foreach($lingotek_locales as $lingotek_locale){
		// Exact match (case-insensitive)
		if(strcasecmp($locale,$lingotek_locale)==0) {
			$found_lingotek_locale = $lingotek_locale;
			break;
		}
		// Dash-insensitive match (case-insensitive)
		if(strcasecmp(str_replace("_", "-", $locale),$lingotek_locale)==0) {
			$found_lingotek_locale = $lingotek_locale;
			break;
		}
	}

	if($found_lingotek_locale==FALSE && !preg_match('/[_\-]/',$locale)){
		// Language only provided, use most likely locale
		if(array_key_exists($locale, $language_default_locales)){
			$found_lingotek_locale = $language_default_locales[$locale];
		}
	}

	return $found_lingotek_locale;
}


$found = 0;
$missing = 0;
$total = 0;
$missing_locales = [];

foreach($new_locale_map as $locale=>$value){
	$lingotek_locale = find_lingotek_locale($locale);
	if($lingotek_locale){
		$new_locale_map[$locale] = $lingotek_locale;
		//echo "$locale => $lingotek_locale (hit) \n";
		$found++;
	} else {
		//echo "$locale (miss)\n";
		$missing_locales[] = $locale;
		$missing++;
	}
	$total ++;
}


if($details) {
	echo "Complete locale map:\n";
	print_r(json_encode($new_locale_map));
	echo "\n";

	echo "\nMissing locales: ".json_encode($missing_locales);

	$collisions = array_count_values($new_locale_map);
	function test($var) { return $var > 1; }
	$collisions = array_filter($collisions, 'test');

	echo "\nCollisions: ".json_encode($collisions);

	echo "\n\n$found/$total mapped (".number_format($found/$total,2)."%) -- $missing mapped to nothing (i.e., \"\")\n";
} else {
	print_r(json_encode($new_locale_map));
}