<?php require_once("sql.php"); ?>

<?php

if (!$_GET["id"]) $_GET["id"] = find_unused_id("overtimes");

$res = mysql_query("
	REPLACE INTO overtimes(id, date, employee, time)
	VALUES (
		'".$_GET["id"]."',"
		."'".$_GET["date"]."',"
		."'".$_GET["employee"]."',"
		."'".$_GET["time"]."');");

?>

<?php include("header.htm"); ?>

<?php

if ($res)
	echo "V pořádku.";
else
	echo "CHYBA!!!";

?>

<?php include("footer.htm"); ?>
