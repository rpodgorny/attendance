<?php require_once("sql.php"); ?>
<?php require_once("goto.php"); ?>

<?php

if (!$_GET["id"]) $_GET["id"] = find_unused_id("days");

$res = db_query("
	REPLACE INTO days(id, date, employee, type)
	VALUES (
		'".$_GET["id"]."',"
		."'".$_GET["date"]."',"
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
