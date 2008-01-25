<?php require_once("sql.php"); ?>

<?php

if (!$_GET["id"]) $_GET["id"] = find_unused_id("actions");

if (!$_GET["date"]) $_GET["date"] = date("Y-m-d");
if (!$_GET["time"]) $_GET["time"] = date("H:i:s");

$res = mysql_query("
	REPLACE INTO actions(id, date, time, employee, type)
	VALUES (
		'".$_GET["id"]."',"
		."'".$_GET["date"]."',"
		."'".$_GET["time"]."',"
		."'".$_GET["employee"]."',"
		."'".$_GET["type"]."');");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="cs" xml:lang="cs">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<title>Docházkový systém</title>
	<link rel="stylesheet" type="text/css" charset="utf-8" media="all" href="common.css" />
	<link rel="stylesheet" type="text/css" charset="utf-8" media="screen" href="screen.css" />
	<meta name="Description" content="Docházkový systém" />
	<meta name="Keywords" content="" />
	<meta name="Author" content="Pavel Podgorný; Radek Podgorný" />

	<?php
		if (strlen($_GET["goto"]) && strpos($_GET["goto"], "-") !== 0 && $res) {
			echo "<meta http-equiv=\"refresh\" content=\"0; url=" . $_GET["goto"] . "\">";
		}
	?>
</head>

<body>

<?php

if ($res) {
	echo "V pořádku.";

	if (strlen($_GET["goto"]) && strpos($_GET["goto"], "-") === 0) {
		echo "<script language=\"javascript\"><!--";
		echo "history.go(" . $_GET["goto"] . ")";
		echo "//--></script>";
	}
} else {
	echo "CHYBA!!!";
}

?>

<?php include("footer.htm"); ?>
