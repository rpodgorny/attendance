<?php require_once("sql.php"); ?>

<?php

if (!$_GET["id"]) $_GET["id"] = find_unused_id("employees");

if ($_GET["active"] != 0) $_GET["active"] = 1;
if ($_GET["stravenky"] != 0) $_GET["stravenky"] = 1;

$res = mysql_query("
	REPLACE INTO employees(id,name,since,active,stravenky)
	VALUES (
		'".$_GET["id"]."',"
		."'".$_GET["name"]."',"
		."'".$_GET["since"]."',"
		."'".$_GET["active"]."',"
		."'".$_GET["stravenky"]."')
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
