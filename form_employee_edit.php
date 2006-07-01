<?php require_once("sql.php"); ?>

<?php

if ($_GET["from_id"]) {
	$name = db_get("employees", "name", $_GET["from_id"]);
	$active = db_get("employees", "active", $_GET["from_id"]);
}

?>

<?php include("header.htm"); ?>

<form action="employee_edit.php" method="GET">

<input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">

<p>
Jméno pracovníka:
<input type="text" name="name" value="<?php echo $name; ?>"/>
</p>

<p>
Aktivní (zatím nefunguje):
<input type="checkbox" name="active" value="<?php echo $active; ?>"/>
</p>

<p>
<input type="submit">
</p>

</form>

<?php include("footer.htm"); ?>
