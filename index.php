<?php require_once("sql.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="cs" xml:lang="cs">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<title>
		Docházkový systém
	</title>
	<link rel="stylesheet" type="text/css" charset="utf-8" media="all" href="touchscreen.css" />
</head>

<body>

<p>
Dobrý den, vítejte v docházkovém systému firmy Asterix a.s. Vyberte prosím své jméno z následujícího seznamu:
</p>

<p>
<ul class="buttons">
<?php

$res = mysql_query("
	SELECT id,name
	FROM employees
	WHERE active=1
	ORDER BY name;
");

while ($row = mysql_fetch_array($res)) {
	echo "<li>";
	echo "<a href=\"touchscreen_2.php?employee=" . $row["id"] . "\">";
	echo $row["name"];
	echo "</a>";
	echo "</li>";
}

?>
</ul>
</p>

<p>
Poslední záznam:
<?php

$res = mysql_query("SELECT actions.id,employees.name,actions.date,actions.time,actions.type FROM actions,employees WHERE actions.employee=employees.id ORDER BY actions.id DESC");
$row = mysql_fetch_array($res);
mysql_free_result($res);

echo $row["name"] . ", " . $row["date"] . " " . $row["time"] . ", " . $row["type"];

?>
</p>

</body>

</html>
