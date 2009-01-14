<?php require_once("sql.php"); ?>
<?php require_once("goto.php"); ?>

<?php

$res = mysql_query("DELETE FROM vacancies WHERE id='" . $_GET["id"] . "';");

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
