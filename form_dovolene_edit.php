<?php require_once("sql.php"); ?>

<?php

$year = $_GET["year"];
$employee = $_GET["employee"];
$days = $_GET["days"];

if ($_GET["from_id"]) {
	$year = db_get("dovolene", "year", $_GET["from_id"]);
	$employee = db_get("dovolene", "employee", $_GET["from_id"]);
	$days = db_get("dovolene", "days", $_GET["from_id"]);
	$days_lastyear = db_get("dovolene", "days_lastyear", $_GET["from_id"]);
} else {
	if (!strlen($year)) $year = date("Y");
}

?>

<?php include("header.htm"); ?>

<form action="dovolene_edit.php" method="GET">

<input type="hidden" name="goto" value="-2">

<input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">

<p>
Rok:
<input type="text" name="year" value="<?php echo $year; ?>"/>
</p>

<p>
Zaměstnanec:
<select name="employee">

<?php

$res = mysql_query("
	SELECT id,name
	FROM employees
	WHERE active='1'
	ORDER BY name
;");

while ($row = mysql_fetch_array($res)) {
	echo "<option value=\"" . $row["id"] . "\"";
	if ($row["id"] == $employee) echo " selected";
	echo ">";
	echo $row["name"];
	echo "</option>";
	echo "\n";
}

?>

</select>
</p>

<p>
Počet dnů:
<input type="text" name="days" value="<?php echo $days; ?>"/>
</p>

<p>
Přenos dovolené z minulého roku (dnů):
<input type="text" name="days_lastyear" value="<?php echo $days_lastyear; ?>"/>
</p>

<p>
<input type="submit">
</p>

</form>

<?php include("footer.htm"); ?>
