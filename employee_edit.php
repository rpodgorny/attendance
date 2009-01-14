<?php require_once("sql.php"); ?>
<?php require_once("goto.php"); ?>

<?php


if ($_GET["active"] != 0) $_GET["active"] = 1;
if ($_GET["stravenky"] != 0) $_GET["stravenky"] = 1;

if (!$_GET["id"]) {
	$res = db_query("
		INSERT INTO employees
		SET
			name='".$_GET["name"]."',
			plusminus='".$_GET["plusminus"]."',
			dovolene='".$_GET["dovolene"]."',
			active='".$_GET["active"]."',
			stravenky='".$_GET["stravenky"]."'
		;");
} else {
	$res = db_query("
		UPDATE employees
		SET
			name='".$_GET["name"]."',
			plusminus='".$_GET["plusminus"]."',
			dovolene='".$_GET["dovolene"]."',
			active='".$_GET["active"]."',
			stravenky='".$_GET["stravenky"]."'
		WHERE id='".$_GET["id"]."'
	;");
}

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
