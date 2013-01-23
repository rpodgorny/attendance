<?php require_once("sql.php"); ?>

<?php

$date = $_GET["date"];
$employee = $_GET["employee"];
$amount = $_GET["amount"];

if ($_GET["from_id"]) {
	$date = db_get("diety", "date", $_GET["from_id"]);
	$employee = db_get("diety", "employee", $_GET["from_id"]);
	$amount = db_get("diety", "amount", $_GET["from_id"]);
} else {
	if (!strlen($date)) $date = date("Y-m-d");
}

?>

<?php include("header.htm"); ?>

<form action="diety_edit.php" method="GET">

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
Korun:
<input type="text" name="amount" value="<?php echo $amount; ?>"/>
</p>

<p>
<input type="submit">
</p>

</form>

<?php include("footer.htm"); ?>
