<?php require_once("sql.php"); ?>

<?php

$res = mysql_query("DELETE FROM employees WHERE id='" . $_GET["id"] . "';");
$res = mysql_query("DELETE FROM actions WHERE employee='" . $_GET["id"] . "';");
$res = mysql_query("DELETE FROM overtimes WHERE employee='" . $_GET["id"] . "';");
$res = mysql_query("DELETE FROM days WHERE employee='" . $_GET["id"] . "';");
$res = mysql_query("DELETE FROM comments WHERE employee='" . $_GET["id"] . "';");

?>

<?php include("header.htm"); ?>

<?php

if ($res)
	echo "V pořádku.";
else
	echo "CHYBA!!!";

?>

<?php include("footer.htm");
