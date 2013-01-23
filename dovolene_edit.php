<?php require_once("sql.php"); ?>
<?php require_once("goto.php"); ?>

<?php

if (!$_GET["id"]) {
	$res = db_query("
		INSERT INTO dovolene
		SET
			year='".$_GET["year"]."',
			employee='".$_GET["employee"]."',
			days='".$_GET["days"]."',
			days_lastyear='".$_GET["days_lastyear"]."'
		;");
} else {
	$res = db_query("
		UPDATE dovolene
		SET
			year='".$_GET["year"]."',
			employee='".$_GET["employee"]."',
			days='".$_GET["days"]."',
			days_lastyear='".$_GET["days_lastyear"]."'
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
