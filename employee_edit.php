<?php require_once("sql.php"); ?>
<?php require_once("goto.php"); ?>

<?php


$active = $_GET["active"] != 0 ? 1 : 0;;
$stravenky = $_GET["stravenky"] != 0 ? 1 : 0;

if (!$_GET["id"]) {
	$res = db_query("
		INSERT INTO employees(name,plusminus,dovolene,active,stravenky)
		VALUES(
			'".$_GET["name"]."',
			'".$_GET["plusminus"]."',
			'".$_GET["dovolene"]."',
			'".$active."',
			'".$stravenky."'
		);");
} else {
	$res = db_query("
		UPDATE employees
		SET
			name='".$_GET["name"]."',
			plusminus='".$_GET["plusminus"]."',
			dovolene='".$_GET["dovolene"]."',
			active='".$active."',
			stravenky='".$stravenky."'
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
