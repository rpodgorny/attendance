<?php require_once("sql.php"); ?>
<?php require_once("goto.php"); ?>

<?php

$employee_prev = db_get('comments', 'employee', $_GET['id']);
$date_prev = db_get('comments', 'date', $_GET['id']);
db_invalidate_cache_totals($employee_prev, $date_prev);

$res = db_query("DELETE FROM comments WHERE id='" . $_GET["id"] . "';");

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
