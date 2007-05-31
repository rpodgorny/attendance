<?php require_once("sql.php"); ?>

<?php

if ($_GET["from_id"]) {
	$name = db_get("employees", "name", $_GET["from_id"]);
	$since = db_get("employees", "since", $_GET["from_id"]);
	$plusminus = db_get("employees", "plusminus", $_GET["from_id"]);
	$dovolene = db_get("employees", "dovolene", $_GET["from_id"]);
	$active = db_get("employees", "active", $_GET["from_id"]);
	$stravenky = db_get("employees", "stravenky", $_GET["from_id"]);
	$uvazek = db_get("employees", "uvazek", $_GET["from_id"]);
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
Datum nástupu:
<input type="text" name="since" value="<?php echo $since; ?>"/>
</p>

<p>
Počáteční plusminus:
<input type="text" name="plusminus" value="<?php echo $plusminus; ?>"/>
</p>

<p>
Počáteční dovolená:
<input type="text" name="dovolene" value="<?php echo $dovolene; ?>"/>
</p>

<p>
Aktivní:
<input type="checkbox" name="active" value="1" <?php if ($active) echo "checked"?>/>
</p>

<p>
Počítat stravenky:
<input type="checkbox" name="stravenky" value="1" <?php if ($stravenky) echo "checked"?>/>
</p>

<p>
Uvazek:
<input type="text" name="uvazek" value="<?php echo $uvazek; ?>"/>
</p>

<p>
<input type="submit">
</p>

</form>

<?php include("footer.htm"); ?>
