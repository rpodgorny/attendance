<?php require_once("sql.php"); ?>
<?php require_once("goto.php"); ?>

<?php

$employee = db_get('uvazky', 'employee', $_GET['id']);
db_invalidate_cache_totals($employee, null);

$res = db_query("DELETE FROM uvazky WHERE id='" . $_GET["id"] . "';");

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
