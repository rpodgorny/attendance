<?php require_once("sql.php"); ?>
<?php require_once("goto.php"); ?>

<?php

if (!$_GET["id"]) $_GET["id"] = find_unused_id("vacancies");

$res = mysql_query("
	REPLACE INTO vacancies(id, date)
	VALUES (
		'".$_GET["id"]."',"
		."'".$_GET["date"]."')
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
