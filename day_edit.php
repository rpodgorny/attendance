<?php require_once("sql.php"); ?>
<?php require_once("goto.php"); ?>

<?php

if (!$_GET["id"]) {
	$res = db_query("
		INSERT INTO days
		SET
			date='".$_GET["date"]."',
			employee='".$_GET["employee"]."',
			type='".$_GET["type"]."'
		;");
} else {
	$res = db_query("
		UPDATE days
		SET
			date='".$_GET["date"]."',
			employee='".$_GET["employee"]."',
			type='".$_GET["type"]."'
		WHERE id='".$_GET["id"]."'
		;")
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
