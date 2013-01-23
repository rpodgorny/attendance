<?php require_once("sql.php"); ?>
<?php require_once("goto.php"); ?>

<?php

if (!$_GET["id"]) {
	$res = db_query("
		INSERT INTO diety(date,employee,amount)
		VALUES(
			'".$_GET["date"]."',
			'".$_GET["employee"]."',
			'".$_GET["amount"]."'
		);");
} else {
	$res = db_query("
		UPDATE diety
		SET
			date='".$_GET["date"]."',
			employee='".$_GET["employee"]."',
			amount='".$_GET["amount"]."'
		WHERE id='".$_GET["id"]."'
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
