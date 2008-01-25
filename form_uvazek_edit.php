<?php require_once("sql.php"); ?>

<?php

$date = $_GET["date"];
$employee = $_GET["employee"];
$time = $_GET["time"];

if ($_GET["from_id"]) {
	$employee = db_get("uvazky", "employee", $_GET["from_id"]);
	$since = db_get("uvazky", "since", $_GET["from_id"]);
	$till = db_get("uvazky", "till", $_GET["from_id"]);
	$uvazek = db_get("uvazky", "uvazek", $_GET["from_id"]);
} else {
	if (!strlen($since)) $since = date("Y-m-d");
	if (!strlen($till)) $till = date("Y-m-d");
}

?>

<?php include("header.htm"); ?>

<form action="uvazek_edit.php" method="GET">

<input type="hidden" name="goto" value="-2">

<input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">

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
Od (yyyy-mm-dd):
<input type="text" name="since" value="<?php echo $since; ?>"/>
</p>

<p>
Do (yyyy-mm-dd):
<input type="text" name="till" value="<?php echo $till; ?>"/>
</p>

<p>
Denní úvazek:
<input type="text" name="uvazek" value="<?php echo $uvazek; ?>"/>
</p>

<p>
<input type="submit">
</p>

</form>

<?php include("footer.htm"); ?>
