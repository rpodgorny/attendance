<?php require_once("sql.php"); ?>

<?php

$date = $_GET["date"];
$employee = $_GET["employee"];
$type = $_GET["type"];

if ($_GET["from_id"]) {
	$date = db_get("days", "date", $_GET["from_id"]);
	$employee = db_get("days", "employee", $_GET["from_id"]);
	$type = db_get("days", "type", $_GET["from_id"]);
} else {
	if (!strlen($date)) $date = date("Y-m-d");
}


?>

<?php include("header.htm"); ?>

<form action="day_edit.php" method="GET">

<input type="hidden" name="goto" value="-2">

<input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">

<p>
Datum (yyyy-mm-dd):
<input type="text" name="date" value="<?php echo $date; ?>"/>
</p>

<p>
Zaměstnanec:
<select name="employee">

<?php

$res = db_query("
	SELECT id,name
	FROM employees
	WHERE active='1'
	ORDER BY name
;");

while ($row = pg_fetch_array($res)) {
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
Typ:
<select name="type">
	<option value="dovolena" <?php if ($type == "dovolena") echo "selected"; ?>>dovolená</option>
	<option value="nemoc" <?php if ($type == "nemoc") echo "selected"; ?>>nemoc</option>
	<option value="nahrada" <?php if ($type == "nahrada") echo "selected"; ?>>náhrada</option>
	<option value="neplacene_volno" <?php if ($type == "neplacene_volno") echo "selected"; ?>>neplacene volno</option>
</select>
</p>

<p>
<input type="submit" value="Ok">
</p>

</form>

<?php include("footer.htm"); ?>
