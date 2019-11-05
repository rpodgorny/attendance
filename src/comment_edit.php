<?php require_once("sql.php"); ?>
<?php require_once("goto.php"); ?>

<?php

if (!$_GET["id"]) {
	$res = db_query("
		INSERT INTO comments(date,employee,text)
		VALUES(
			'".$_GET["date"]."',
			'".$_GET["employee"]."',
			'".$_GET["text"]."'
		);");
} else {
	$employee_prev = db_get('comments', 'employee', $_GET['id']);
	$date_prev = db_get('comments', 'date', $_GET['id']);
	db_invalidate_cache_totals($employee_prev, $date_prev);

	$res = db_query("
		UPDATE comments
		SET
			date='".$_GET["date"]."',
			employee='".$_GET["employee"]."',
			text='".$_GET["text"]."'
		WHERE id='".$_GET["id"]."'
		;");
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
