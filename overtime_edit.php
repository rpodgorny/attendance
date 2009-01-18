<?php require_once("sql.php"); ?>
<?php require_once("goto.php"); ?>

<?php

if (!$_GET["id"]) {
	$res = db_query("
		INSERT INTO overtimes
		SET
			date='".$_GET["date"]."',
			employee='".$_GET["employee"]."',
			time='".$_GET["time"]."'
		;");
} else {
	$res = db_query("
		UPDATE overtimes
		SET
			date='".$_GET["date"]."',
			employee='".$_GET["employee"]."',
			time='".$_GET["time"]."'
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
