<?php require_once("sql.php"); ?>
<?php require_once("goto.php"); ?>

<?php

if (!$_GET["date"]) $_GET["date"] = date("Y-m-d");
if (!$_GET["time"]) $_GET["time"] = date("H:i:s");

if (!$_GET["id"]) {
	$res = db_query("
		INSERT INTO actions(date,time,employee,type)
		VALUES(
			'".$_GET["date"]."',
			'".$_GET["time"]."',
			'".$_GET["employee"]."',
			'".$_GET["type"]."'
		);");
	pg_free_result($res);
} else {
	$employee_prev = db_get('actions', 'employee', $_GET['id']);
	$date_prev = db_get('actions', 'date', $_GET['id']);
	db_invalidate_cache_totals($employee_prev, $date_prev);

	$res = db_query("
		UPDATE actions
		SET
			date='".$_GET["date"]."',
			time='".$_GET["time"]."',
			employee='".$_GET["employee"]."',
			type='".$_GET["type"]."'
		WHERE id=".$_GET["id"]."
		;");
	pg_free_result($res);
}

db_invalidate_cache_totals($_GET["employee"], $_GET["date"]);

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
