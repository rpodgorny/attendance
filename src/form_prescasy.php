<?php require_once("auth.php"); ?>
<?php require_once("sql.php"); ?>

<?php include("header.htm"); ?>
<?php auth_header(); ?>
<?php include("menu.htm"); ?>

<div class="selection">
<form action="prescasy.php" method="GET">
<h3>Uznané přesčasy</h3>
<p>
Rok:<br />
<input type="text" name="year" value="<?php echo date("Y"); ?>"/>
</p>

<p>
Měsíc:<br />
<input type="text" name="month" value="<?php echo date("m"); ?>"/>
</p>

<p>
Zaměstnanec:<br />
<select name="employee">

<?php

$res = db_query("
	SELECT id,name
	FROM employees
	WHERE active='1'
	ORDER BY name;
");

while ($row = pg_fetch_array($res)) {
	echo "<option value=\"" . $row["id"] . "\">";
	echo $row["name"];
	echo "</option>";
}

?>

</select>
</p>

<p>
<input type="submit" value="Zobrazit">
</p>
</form>
</div>

<?php include("footer.htm"); ?>
