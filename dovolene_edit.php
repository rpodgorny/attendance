<?php require_once("sql.php"); ?>
<?php require_once("goto.php"); ?>

<?php

if (!$_GET["id"]) $_GET["id"] = find_unused_id("dovolene");

$res = db_query("
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

if ($res) {
	echo "V pořádku.";

	handle_goto_body($_GET["goto"]);
} else {
	echo "CHYBA!!!";
}

?>

<?php include("footer.htm"); ?>
