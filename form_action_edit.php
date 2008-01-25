<?php require_once("sql.php"); ?>

<?php

if ($_GET["from_id"]) {
	$date = db_get("actions", "date", $_GET["from_id"]);
	$time = db_get("actions", "time", $_GET["from_id"]);
	$employee = db_get("actions", "employee", $_GET["from_id"]);
	$type = db_get("actions", "type", $_GET["from_id"]);
} else {
	$date = date("Y-m-d");
	$time = date("H:i:s");
}


?>

<?php include("header.htm"); ?>

<form action="action_edit.php" method="GET">

<input type="hidden" name="goto" value="-2">
<input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">

<p>
Datum (yyyy-mm-dd):
<input type="text" name="date" value="<?php echo $date; ?>"/>
</p>

<p>
Čas (hh:mm:ss):
<input type="text" name="time" value="<?php echo $time; ?>"/>
</p>

<p>
Zaměstnanec:
<select name="employee">

<?php

$res = mysql_query("
	SELECT id,name
	FROM employees
	WHERE active='1'
	ORDER by name;
");

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
Typ:
<select name="type">
<?php
	$types_str = "prichod,odchod,odchod-obed,odchod-sluzebne-praha,odchod-sluzebne-mimopraha,odchod-lekar";
	$types = explode(",", $types_str);

	for ($i = 0; $i < count($types); $i++) {
		echo "<option value=\"" . $types[$i] . "\"";
		if ($type == $types[$i]) echo " selected";
		echo ">" . $types[$i] . "</option>";
		echo "\n";
	}

?>
</select>
</p>

<p>
<input type="submit">
</p>

</form>

<?php include("footer.htm"); ?>
