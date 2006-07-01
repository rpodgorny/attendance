<?php require_once("sql.php"); ?>

<?php

if (!$_GET["id"]) $_GET["id"] = find_unused_id("employees");

$res = mysql_query("
	REPLACE INTO employees(id,name)
	VALUES (
		'".$_GET["id"]."',"
		."'".$_GET["name"]."')
;");

?>

<?php include("header.htm"); ?>

<?php

if ($res)
	echo "V pořádku.";
else
	echo "CHYBA!!!";

?>

<?php include("footer.htm"); ?>
