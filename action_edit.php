<?php require_once("sql.php"); ?>
<?php require_once("goto.php"); ?>

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

<?php include("header.htm"); ?>

<?php

if ($res) {
	echo "V pořádku.";

	handle_goto_body($_GET["goto"]);
} else {
	echo "CHYBA!!!";
}

?>

<?php include("footer.htm"); ?>
