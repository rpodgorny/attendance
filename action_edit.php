<?php require_once("sql.php"); ?>
<?php require_once("goto.php"); ?>

<?php

if (!$_GET["date"]) $_GET["date"] = date("Y-m-d");
if (!$_GET["time"]) $_GET["time"] = date("H:i:s");

if (!$_GET["id"]) {
	$res = mysql_query("
		INSERT INTO actions
		SET
			date='".$_GET["date"]."',
			time='".$_GET["time"]."',
			employee='".$_GET["employee"]."',
			type='".$_GET["type"]."'
		;");
} else {
	$res = mysql_query("
		UPDATE actions
		SET
			date='".$_GET["date"]."',
			time='".$_GET["time"]."',
			employee='".$_GET["employee"]."',
			type='".$_GET["type"]."'
		WHERE id=".$_GET["id"]."
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
