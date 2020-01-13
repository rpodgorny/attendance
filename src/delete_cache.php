<?php require_once("sql.php"); ?>
<?php require_once("goto.php"); ?>

<?php

$res = db_query("DELETE FROM cache_day_totals;");
pg_free_result($res);
$res = db_query("DELETE FROM cache_month_totals;");
pg_free_result($res);

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
