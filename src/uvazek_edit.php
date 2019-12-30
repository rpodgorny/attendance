<?php require_once("sql.php"); ?>
<?php require_once("goto.php"); ?>

<?php

if (!$_GET["id"]) {
	$res = db_query("
		INSERT INTO uvazky(employee,since,till,uvazek)
		VALUES(
			'".$_GET["employee"]."',
			'".$_GET["since"]."',
			'".$_GET["till"]."',
			'".$_GET["uvazek"]."'
		);");
} else {
	$employee_prev = db_get('uvazky', 'employee', $_GET['id']);
	db_invalidate_cache_totals($employee_prev, null);

	$res = db_query("
		UPDATE uvazky
		SET
			employee='".$_GET["employee"]."',
			since='".$_GET["since"]."',
			till='".$_GET["till"]."',
			uvazek='".$_GET["uvazek"]."'
		WHERE id='".$_GET["id"]."'
		;");
}

db_invalidate_cache_totals($_GET["employee"], null);

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
