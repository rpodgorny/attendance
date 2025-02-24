<?php require_once("auth.php"); ?>
<?php require_once("sql.php"); ?>
<?php require_once("datetime.php"); ?>

<?php

function day_totals($year, $month, $day, $employee) {
	$at_work = false;
	$at_lunch = false;
	$at_cesta_praha = false;
	$at_cesta_mimopraha = false;
	$at_doctor = false;
	$secs_old = 0;

	$total["odpracovano"] = 0;
	$total["stravenky"] = 0;
	$total["diety_kc"] = 0;
	$total["daylog"] = "";
	$total["error"] = 0;

	$str_date = $year . "-" . $month . "-" . $day;

	$res = db_query("
		SELECT *
		FROM cache_day_totals
		WHERE
			employee='" . $employee . "'
			AND date='" . $str_date . "'
	;");
	$row = pg_fetch_array($res);
	if ($row) {
		$total = $row;
		pg_free_result($res);
		return $total;
	}

	//error_log("day_totals(" . $year . "," . $month . "," . $day . "," . $employee . ") begin");
	$res = db_query("
		SELECT time,type
		FROM actions
		WHERE
			employee='" . $employee . "'
			AND date='" . $str_date . "'
		ORDER BY time ASC
	;");

	// This is nasty
	for (;;) {
		$row = pg_fetch_array($res);

		if (!$row) {
			if ($at_work
			|| $at_lunch
			|| $at_cesta_praha
			|| $at_cesta_mimopraha
			|| $at_doctor) {
				$total["daylog"] .= "neočekávaný konec dne";
				$total["error"] = true;
			}
			break;
		}

		// Get rid of this somehow
		if (!$at_work
		&& !$at_lunch
		&& !$at_cesta_praha
		&& !$at_cesta_mimopraha
		&& !$at_doctor
		&& strlen($total["daylog"])) {
			$total["daylog"] .= " - nic - ";
		}

		$secs = datetime_to_secs($row["time"]);

		$total["daylog"] .= secs_to_time($secs);

		if ($row["type"] == "prichod") {
			if ($at_work) {
				$total["daylog"] .= "dvojí příchod";
				$total["error"] = true;
				break;
			}
			if ($at_cesta_mimopraha) {
				$total["odpracovano"] += $secs - $secs_old;
				if ($secs - $secs_old > 18*60*60) {
					if ($year >= 2025) {
						$total["diety_kc"] = 360;
					} elseif ($year >= 2024) {
						$total["diety_kc"] = 340;
					} elseif ($year >= 2023) {
						$total["diety_kc"] = 310;
					} elseif ($year >= 2022 && $month >= 9) {
						$total["diety_kc"] = 285;
					} elseif ($year >= 2022) {
						$total["diety_kc"] = 250;
					} elseif ($year >= 2020) {
						$total["diety_kc"] = 230;
					} elseif ($year >= 2019) {
						$total["diety_kc"] = 195;
					} elseif ($year >= 2018) {
						$total["diety_kc"] = 186;
					} elseif ($year >= 2017) {
						$total["diety_kc"] = 171;
					} elseif ($year >= 2016) {
						$total["diety_kc"] = 166;
					} elseif ($year >= 2015) {
						$total["diety_kc"] = 163;
					} elseif ($year >= 2014) {
						$total["diety_kc"] = 160;
					} elseif ($year >= 2013) {
						$total["diety_kc"] = 157;
					} elseif ($year >= 2012) {
						$total["diety_kc"] = 166;
					} else {
						$total["diety_kc"] = 150;
					}
				} else if ($secs - $secs_old > 12*60*60) {
					if ($year >= 2025) {
						$total["diety_kc"] = 230;
					} elseif ($year >= 2024) {
						$total["diety_kc"] = 220;
					} elseif ($year >= 2023) {
						$total["diety_kc"] = 200;
					} elseif ($year >= 2022 && $month >= 9) {
						$total["diety_kc"] = 180;
					} elseif ($year >= 2022) {
						$total["diety_kc"] = 160;
					} elseif ($year >= 2020) {
						$total["diety_kc"] = 150;
					} elseif ($year >= 2019) {
						$total["diety_kc"] = 124;
					} elseif ($year >= 2018) {
						$total["diety_kc"] = 119;
					} elseif ($year >= 2017) {
						$total["diety_kc"] = 109;
					} elseif ($year >= 2016) {
						$total["diety_kc"] = 106;
					} elseif ($year >= 2015) {
						$total["diety_kc"] = 104;
					} elseif ($year >= 2014) {
						$total["diety_kc"] = 102;
					} elseif ($year >= 2013) {
						$total["diety_kc"] = 100;
					} elseif ($year >= 2012) {
						$total["diety_kc"] = 106;
					} else {
						$total["diety_kc"] = 96;
					}
				} else if ($secs - $secs_old > 5*60*60) {
					if ($year >= 2025) {
						$total["diety_kc"] = 150;
					} elseif ($year >= 2024) {
						$total["diety_kc"] = 140;
					} elseif ($year >= 2023) {
						$total["diety_kc"] = 130;
					} elseif ($year >= 2022 && $month >= 9) {
						$total["diety_kc"] = 120;
					} elseif ($year >= 2022) {
						$total["diety_kc"] = 110;
					} elseif ($year >= 2020) {
						$total["diety_kc"] = 100;
					} elseif ($year >= 2019) {
						$total["diety_kc"] = 82;
					} elseif ($year >= 2018) {
						$total["diety_kc"] = 78;
					} elseif ($year >= 2017) {
						$total["diety_kc"] = 72;
					} elseif ($year >= 2016) {
						$total["diety_kc"] = 70;
					} elseif ($year >= 2015) {
						$total["diety_kc"] = 69;
					} elseif ($year >= 2014) {
						$total["diety_kc"] = 67;
					} elseif ($year >= 2013) {
						$total["diety_kc"] = 66;
					} elseif ($year >= 2012) {
						$total["diety_kc"] = 70;
					} else {
						$total["diety_kc"] = 63;
					}
				}
				$at_cesta_mimopraha = false;
			}
			if ($at_cesta_praha) {
				$total["odpracovano"] += $secs - $secs_old;
				$at_cesta_praha = false;
			}
			if ($at_lunch) {
				$at_lunch = false;
			}
			if ($at_doctor) {
				$total["odpracovano"] += $secs - $secs_old;
				$at_doctor = false;
			}
			$at_work = true;
		} else if ($row["type"] == "odchod") {
			if (!$at_work) {
				$total["daylog"] .= "odchod bez příchodu";
				$total["error"] = 1;
				break;
			}
			$total["odpracovano"] += $secs - $secs_old;
			$at_work = false;
		} else if ($row["type"] == "odchod-obed") {
			if (!$at_work) {
				$total["daylog"] .= "odchod na oběd bez příchodu";
				$total["error"] = 1;
				break;
			}
			$total["odpracovano"] += $secs - $secs_old;
			$at_work = false;
			$at_lunch = true;
		} else if ($row["type"] == "odchod-sluzebne-mimopraha") {
			if (!$at_work) {
				$total["daylog"] .= "odchod na sl. cestu bez příchodu";
				$total["error"] = 1;
				break;
			}
			$total["odpracovano"] += $secs - $secs_old;
			$at_work = false;
			$at_cesta_mimopraha = true;
		} else if ($row["type"] == "odchod-sluzebne-praha") {
			if (!$at_work) {
				$total["daylog"] .= "odchod na sl. cestu bez příchodu";
				$total["error"] = 1;
				break;
			}
			$total["odpracovano"] += $secs - $secs_old;
			$at_work = false;
			$at_cesta_praha = true;
		} else if ($row["type"] == "odchod-lekar") {
			if (!$at_work) {
				$total["daylog"] .= "odchod k lékaři bez příchodu";
				$total["error"] = 1;
				break;
			}
			$total["odpracovano"] += $secs - $secs_old;
			$at_work = false;
			$at_doctor = true;
		} else {
			$total["daylog"] .= "neznamý typ průchodu";
			$total["error"] = 1;
			break;
		}

		$secs_old = $secs;

		if ($at_work) $total["daylog"] .= " - práce - ";
		if ($at_lunch) $total["daylog"] .= " - oběd - ";
		if ($at_cesta_praha) $total["daylog"] .= " - cesta Praha - ";
		if ($at_cesta_mimopraha) $total["daylog"] .= " - cesta mimo Prahu - ";
		if ($at_doctor) $total["daylog"] .= " - lékař - ";
	}
	pg_free_result($res);

	$res = db_query("
		SELECT id,time
		FROM overtimes
		WHERE
			date='" . $str_date . "'
			AND employee='" . $employee . "'
	;");
	$row = pg_fetch_array($res);
	$total["overtime_id"] = $total["overtime_time"] = 0;
	if ($row) {
		$total["overtime_id"] = $row["id"];
		$total["overtime_time"] = datetime_to_secs($row["time"]);
	}
	pg_free_result($res);

	$res = db_query("
		SELECT id,type
		FROM days
		WHERE
			date='" . $str_date . "'
			AND employee='" . $employee . "'
	;");
	$row = pg_fetch_array($res);
	$total["status_id"] = 0;
	$total["status_type"] = "";
	if ($row) {
		$total["status_id"] = $row["id"];
		$total["status_type"] = $row["type"];
	}
	pg_free_result($res);

	$res = db_query("
		SELECT id,amount
		FROM diety
		WHERE
			date='" . $str_date . "'
			AND employee='" . $employee . "'
	;");
	$row = pg_fetch_array($res);
	$total["diety_id"] = 0;
	if ($row) {
		$total["diety_kc"] = $row["amount"];
		$total["diety_id"] = $row["id"];
	}
	pg_free_result($res);

	$res = db_query("
		SELECT id,text
		FROM comments
		WHERE
			employee='" . $employee . "'
			AND date='" . $str_date . "'
	;");
	$row = pg_fetch_array($res);
	$total["comment_id"] = 0;
	$total["comment_text"] = "";
	if ($row) {
		$total["comment_id"] = $row["id"];
		$total["comment_text"] = $row["text"];
	}
	pg_free_result($res);

	$res = db_query("
		SELECT uvazek
		FROM uvazky
		WHERE
			employee='" . $employee . "'
			AND since<='" . $str_date . "'
			AND (till>='" . $str_date . "' OR till IS NULL)
	;");
	$row = pg_fetch_array($res);
	$uvazek = $row["uvazek"];

	$ratio = $uvazek / 8.0;

	$total["plusminus"] = $total["odpracovano"];
	if (is_workday($year, $month, $day)
	&& $total["status_type"] != "nemoc"
	&& $total["status_type"] != "dovolena"
	&& $total["status_type"] != "nahrada"
	&& $total["status_type"] != "neplacene_volno") {
		$total["plusminus"] -= $uvazek*60*60;

		if (!$total["diety_id"] && $total["diety_kc"] == 0)
			$total["stravenky"] += $ratio;
	}

	// We don't want negative plusminus for days in the future
	if (mktime() < mktime(0, 0, 0, $month, $day, $year)) {
		$total["plusminus"] = 0;
	}

	// don't cache days in the future
	if (mktime() < mktime(0, 0, 0, $month, $day, $year)) {
		$res = db_query("
			INSERT INTO cache_day_totals(date,employee,odpracovano,stravenky,diety_id,diety_kc,daylog,plusminus,status_id,status_type,comment_id,comment_text,overtime_id,overtime_time,error)
			VALUES(
				'".$str_date."',
				'".$employee."',
				'".$total["odpracovano"]."',
				'".$total["stravenky"]."',
				'".$total["diety_id"]."',
				'".$total["diety_kc"]."',
				'".$total["daylog"]."',
				'".$total["plusminus"]."',
				'".$total["status_id"]."',
				'".$total["status_type"]."',
				'".$total["comment_id"]."',
				'".$total["comment_text"]."',
				'".$total["overtime_id"]."',
				'".$total["overtime_time"]."',
				'".$total["error"]."'
			);");
		pg_free_result($res);
	}

	//error_log("day_totals(" . $year . "," . $month . "," . $day . "," . $employee . ") end");
	return $total;
}

function month_totals($year, $month, $employee) {
	$res = db_query("
		SELECT *
		FROM cache_month_totals
		WHERE
			employee='" . $employee . "'
			AND year='" . $year . "'
			AND month='" . $month . "'
	;");
	$row = pg_fetch_array($res);
	if ($row) {
		$total = $row;
		pg_free_result($res);
		return $total;
	}

	error_log("month_totals(" . $year . "," . $month . "," . $employee . ") begin");
	$total["odpracovano"] = 0;
	$total["plusminus"] = 0;
	$total['overtime'] = 0;
	$total["days_nemoc"] = 0;
	$total["days_dovolena"] = 0;
	$total["stravenky"] = 0;
	$total["diety_kc"] = 0;
	$total["error"] = 0;

	for ($day = 1; checkdate($month, $day, $year); $day++) {
		$dt = day_totals($year, $month, $day, $employee);

		$total["odpracovano"] += $dt["odpracovano"];
		$total["plusminus"] += $dt["plusminus"];
		$total["overtime"] += $dt["overtime_time"];

		if ($dt["status_type"] == "nemoc") $total["days_nemoc"]++;
		if ($dt["status_type"] == "dovolena") $total["days_dovolena"]++;

		$total["stravenky"] += $dt["stravenky"];
		$total["diety_kc"] += $dt["diety_kc"];

		if ($dt["error"]) $total["error"] = 1;
	}

	$res = db_query("
		INSERT INTO cache_month_totals(year,month,employee,odpracovano,plusminus,overtime,days_nemoc,days_dovolena,stravenky,diety_kc,error)
		VALUES(
			'".$year."',
			'".$month."',
			'".$employee."',
			'".$total["odpracovano"]."',
			'".$total["plusminus"]."',
			'".$total["overtime"]."',
			'".$total["days_nemoc"]."',
			'".$total["days_dovolena"]."',
			'".$total["stravenky"]."',
			'".$total["diety_kc"]."',
			'".$total["error"]."'
		);");
	pg_free_result($res);

	error_log("month_totals(" . $year . "," . $month . "," . $employee . ") end");
	return $total;
}

function month_totals_print($year, $month, $employee) {
	echo "<table class=\"maxwidth\">";
	echo "<tr>";
	echo "<th colspan=\"2\">den</th>";
	echo "<th>průchody</th>";
	echo "<th>odprac.</th>";
	echo "<th>+/-</th>";
	echo "<th>uznaný přesčas</th>";
	echo "<th>stav</th>";
	echo "<th>diety/strav.</th>";
	echo "<th>poznámka</th>";
	echo "</tr>";

	for ($day = 1; checkdate($month, $day, $year); $day++) {
		$dt = day_totals($year, $month, $day, $employee);

		$str_date = $year . "-" . $month . "-" . $day;

		if (is_workday($year, $month, $day)) {
			echo "<tr class=\"workday\">";
		} else {
			echo "<tr class=\"noworkday\">";
		}

		echo "<td>" . $day . "</td>";
		echo "<td>" . weekdayname($year, $month, $day) . "</td>";

		echo $dt["error"] ? "<td class=\"error\">" : "<td>";
		echo $dt["daylog"];
		if (auth()) {
			echo " <a href=\"list_actions.php?date=" . $str_date . "&employee=" . $employee . "\">(*)</a>";
		}
		echo "</td>";

		echo "<td>" . secs_to_time($dt["odpracovano"]) . "</td>";
		echo "<td>" . secs_to_time($dt["plusminus"]) . "</td>";

		echo "<td>";
		echo secs_to_time($dt["overtime_time"]);
		if (auth()) {
			if ($dt["overtime_id"]) {
				echo " <a href=\"form_overtime_edit.php?from_id=" . $dt["overtime_id"] . "&id=" . $dt["overtime_id"] . "\">(*)</a>";
				echo " <a href=\"form_overtime_delete.php?id=" . $dt["overtime_id"] . "\">(-)</a>";
			} else {
				echo " <a href=\"form_overtime_edit.php?date=" . $str_date . "&employee=" . $employee . "&time=" . secs_to_time($dt["plusminus"]) . "\">(+)</a>";
			}
		}
		echo "</td>";

		echo "<td>";
		echo $dt["status_type"];

		if (strlen($dt["status_type"])) echo "/";
		if (is_holiday($year, $month, $day)) echo "svátek";

		if (auth()) {
			if ($dt["status_id"]) {
				echo " <a href=\"form_day_edit.php?from_id=" . $dt["status_id"] . "&id=" . $dt["status_id"] . "\">(*)</a>";
				echo " <a href=\"form_day_delete.php?id=" . $dt["status_id"] . "\">(-)</a>";
			} else {
				echo " <a href=\"form_day_edit.php?date=" . $str_date . "&employee=" . $employee . "\">(+)</a>";
			}
		}
		echo "</td>";

		echo "<td>";
		echo $dt["diety_kc"] . "/" . $dt["stravenky"];
		if (auth()) {
			if ($dt["diety_id"]) {
				echo " <a href=\"form_diety_edit.php?from_id=" . $dt["diety_id"] . "&id=" . $dt["diety_id"] . "\">(*)</a>";
				echo " <a href=\"form_diety_delete.php?id=" . $dt["diety_id"] . "\">(-)</a>";
			} else {
				echo " <a href=\"form_diety_edit.php?date=" . $str_date . "&employee=" . $employee . "\">(+)</a>";
			}
		}
		echo "</td>";

		echo "<td>";
		echo $dt["comment_text"];
		if (auth()) {
			if ($dt["comment_id"]) {
				echo " <a href=\"form_comment_edit.php?from_id=" . $dt["comment_id"] . "&id=" . $dt["comment_id"] . "\">(*)</a>";
				echo " <a href=\"form_comment_delete.php?id=" . $dt["comment_id"] . "\">(-)</a>";
			} else {
				echo " <a href=\"form_comment_edit.php?date=" . $str_date . "&employee=" . $employee . "\">(+)</a>";
			}
		}
		echo "</td>";

		echo "</tr>\n";
	}

	echo "</table>";
}

?>
