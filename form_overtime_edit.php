<?php require_once("sql.php"); ?>

<?php

$date = $_GET["date"];
$employee = $_GET["employee"];
$time = $_GET["time"];

if ($_GET["from_id"]) {
	$date = db_get("overtimes", "date", $_GET["from_id"]);
	$employee = db_get("overtimes", "employee", $_GET["from_id"]);
	$time = db_get("overtimes", "time", $_GET["from_id"]);
} else {
	if (!strlen($date)) $date = date("Y-m-d");
}

?>

<?php include("header.htm"); ?>

<form action="overtime_edit.php" method="GET">

<input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">

<p>
Datum (yyyy-mm-dd):
<input type="text" name="date" value="<?php echo $date; ?>"/>
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
Počet hodin:
<input type="text" name="time" value="<?php echo $time; ?>"/>
</p>

<p>
<input type="submit">
</p>

</form>

<?php include("footer.htm"); ?>
