<?php require_once("sql.php"); ?>
<?php require_once("goto.php"); ?>

<?php

if (!$_GET["id"]) $_GET["id"] = find_unused_id("uvazky");

$res = db_query("
	REPLACE INTO uvazky(id, employee, since, till, uvazek)
	VALUES (
		'".$_GET["id"]."',"
		."'".$_GET["employee"]."',"
		."'".$_GET["since"]."',"
		."'".$_GET["till"]."',"
		."'".$_GET["uvazek"]."');");

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
