<?php require_once("sql.php"); ?>
<?php require_once("goto.php"); ?>

<?php

if (!$_GET["id"]) {
	$res = db_query("
		INSERT INTO vacancies(date)
		VALUES('" . $_GET['date'] . "')
	;");
} else {
	$res = db_query("
		UPDATE vacancies
		SET date='" . $_GET['date'] . "'
		WHERE id=" . $_GET['id'] . "
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
