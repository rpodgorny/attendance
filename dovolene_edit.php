<?php require_once("sql.php"); ?>

<?php

if (!$_GET["id"]) $_GET["id"] = find_unused_id("dovolene");

$res = mysql_query("
	REPLACE INTO dovolene(id, year, employee, days, days_lastyear)
	VALUES (
		'".$_GET["id"]."',"
		."'".$_GET["year"]."',"
		."'".$_GET["employee"]."',"
		."'".$_GET["days"]."',"
		."'".$_GET["days_lastyear"]."');");

?>

<?php include("header.htm"); ?>

<?php

if ($res)
	echo "V pořádku.";
else
	echo "CHYBA!!!";

?>

<?php include("footer.htm"); ?>
