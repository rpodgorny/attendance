<?php require_once("sql.php"); ?>
<?php require_once("goto.php"); ?>

<?php

if (!$_GET["id"]) $_GET["id"] = find_unused_id("employees");

if ($_GET["active"] != 0) $_GET["active"] = 1;
if ($_GET["stravenky"] != 0) $_GET["stravenky"] = 1;

$res = db_query("
	INSERT INTO employees
	SET
		id='".$_GET["id"]."',"
		."name='".$_GET["name"]."',"
		."plusminus='".$_GET["plusminus"]."',"
		."dovolene='".$_GET["dovolene"]."',"
		."active='".$_GET["active"]."',"
		."stravenky='".$_GET["stravenky"]."'
	ON DUPLICATE KEY UPDATE
		id='".$_GET["id"]."',"
		."name='".$_GET["name"]."',"
		."plusminus='".$_GET["plusminus"]."',"
		."dovolene='".$_GET["dovolene"]."',"
		."active='".$_GET["active"]."',"
		."stravenky='".$_GET["stravenky"]."'
;");

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
