<?php

function datetime_to_secs($date) {
	$neg = false;
	if ($date[0] == '-') {
		$neg = true;
		$date = substr($date, 1);
	}

	if (strlen($date) == 19)
		$secs = substr($date, 11, 2)*60*60 + substr($date, 14, 2)*60 + substr($date, 17, 2);
	else if (strlen($date) == 8)
		$secs = substr($date, 0, 2)*60*60 + substr($date, 3, 2)*60 + substr($date, 6, 2);
	else
		$secs = 0;

	if ($neg) $secs = -$secs;

	return $secs;
}

function secs_to_time($secs) {
	if ($secs < 0) {
		$time = "-";
		$secs = -$secs;
	}

	$time = '';
	$time .= floor($secs / (60*60));
	$secs %= 60*60;
	$time .= ":";
	if (floor($secs / 60) < 10) $time .= "0";
	$time .= floor($secs / 60);
//	$secs %= 60;
//	$time .= ":";
//	if ($secs < 10) $time .= "0";
//	$time .= $secs;

	return $time;
}

function date_to_string($year, $month, $day) {
	$str = $year;
	$str .= "-";
	if (strlen($month) < 2) $str .= "0";
	$str .= $month;
	$str .= "-";
	if (strlen($day) < 2) $str .= "0";
	$str .= $day;

	return $str;
}

function weekdayname($year, $month, $day) {
	$date = getdate(mktime(0, 0, 0, $month, $day, $year));

	switch ($date["wday"]) {
		case 0: return "Ne";
		case 1: return "Po";
		case 2: return "Út";
		case 3: return "St";
		case 4: return "Čt";
		case 5: return "Pá";
		case 6: return "So";
	}
}

function monthname($month) {
	switch ($month) {
		case 1: return "leden";
		case 2: return "únor";
		case 3: return "březen";
		case 4: return "duben";
		case 5: return "květen";
		case 6: return "červen";
		case 7: return "červenec";
		case 8: return "srpen";
		case 9: return "září";
		case 10: return "říjen";
		case 11: return "listopad";
		case 12: return "prosinec";
	}
}

function is_holiday($year, $month, $day) {
	$date = date_to_string($year, $month, $day);
	$res = db_query("SELECT id FROM vacancies WHERE date='". $date ."'");
	$row = pg_fetch_array($res);
	pg_free_result($res);

	if ($row) return true;

	return false;
}

function is_workday($year, $month, $day) {
	$date = getdate(mktime(0, 0, 0, $month, $day, $year));

	if ($date["wday"] == 0 || $date["wday"] == 6) return false;

	if (is_holiday($year, $month, $day)) return false;

	return true;
}

?>
