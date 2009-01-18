<?php require_once("sql.php"); ?>
<?php require_once("goto.php"); ?>

<?php

if (!$_GET["id"]) {
	$res = db_query("
		INSERT INTO uvazky
		SET
			employee='".$_GET["employee"]."',
			since='".$_GET["since"]."',
			till='".$_GET["till"]."',
			uvazek='".$_GET["uvazek"]."'
		;");
} else {
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
