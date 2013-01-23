<?php require_once("sql.php"); ?>
<?php require_once("goto.php"); ?>

<?php

$res = db_query("DELETE FROM employees WHERE id='" . $_GET["id"] . "';");
$res = db_query("DELETE FROM actions WHERE employee='" . $_GET["id"] . "';");
$res = db_query("DELETE FROM overtimes WHERE employee='" . $_GET["id"] . "';");
$res = db_query("DELETE FROM uvazky WHERE employee='" . $_GET["id"] . "';");
$res = db_query("DELETE FROM days WHERE employee='" . $_GET["id"] . "';");
$res = db_query("DELETE FROM comments WHERE employee='" . $_GET["id"] . "';");

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
