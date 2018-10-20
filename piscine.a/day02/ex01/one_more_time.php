#!/usr/bin/php
<?php 
function fr_month_to_dd($month) {
	$my_array = array(
		"Janvier" => "01",
		"Février" => "02",
		"Mars" => "03",
		"Avril" => "04",
		"Mai" => "05",
		"Juin" => "06",
		"Juillet" => "07",
		"Août" => "08",
		"Septembre" => "09",
		"Octobre" => "10",
		"Novembre" => "11",
		"Décembre" => "12"
	);
	$rc= "00";
	foreach($my_array as $month_litteral => $mm) {
		if ($month == $month_litteral)
			  $rc = $mm;
	}
	return($rc);
}

if ($argc == 2) {
	$str = ucwords($argv[1]);

	$my_day_name = "^(Lundi|Mardi|Mercredi|Jeudi|Vendredi|Samedi|Dimanche)";
	$my_day = "([0]?[1-9]|[12]\d|3[01])";
	$my_month_in_french = "(Janvier|Février|Mars|Avril|Mai|Juin|Juillet|Août|Septembre|Octobre|Novembre|Décembre)";
	$my_year = "(\d{4})";
	$my_time = "([0-1]\d|2[0-3]):([0-5]\d):([0-5]\d)$";

	$my_reg_exp = "$my_day_name\s$my_day\s$my_month_in_french\s$my_year\s$my_time";

	$nb = preg_match("/$my_reg_exp/", $str, $matches);

	if($nb != 1) {
		echo "Wrong Format\n";
	} else {
		$day_name = $matches[1];
		$day_num = $matches[2];
		$month_name = $matches[3];
		$month_num = fr_month_to_dd($month_name);
		$year = $matches[4];
		$time = "$matches[5]:$matches[6]:$matches[7]";

		date_default_timezone_set('Europe/Paris');
		$ts=strtotime("$year-$month_num-$day_num $time");
		echo "$ts\n";
	}
}

?>
