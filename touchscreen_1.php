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

$res = db_query("
	SELECT id,name
	FROM employees
	WHERE active=1
	ORDER BY name;
");

while ($row = mysql_fetch_array($res)) {
	$res2 = db_query("
		select type
		from actions
		where employee=" . $row["id"] . " and date<=curdate()
		order by date desc,time desc limit 1;
	");
	$row2 = mysql_fetch_array($res2);

	$status = '?';
	switch ($row2['type']) {
		case 'prichod': $status = 'pritomen'; break;
		case 'odchod': $status = 'nepritomen'; break;
		case 'odchod-obed': $status = 'obed'; break;
		case 'odchod-sluzebne-praha':
		case 'odchod-sluzebne-mimopraha': $status = 'sluzebni-cesta'; break;
		case 'odchod-lekar': $status = 'lekar'; break;
	}

	echo "<li>";
	echo "<img class=\"status\" src=\"" . $status . ".png\">";
	echo "<a href=\"touchscreen_2.php?employee=" . $row["id"] . "\">";
	echo $row["name"];
	echo "</a>";
	echo "</li>";

	mysql_free_result($res2);
}
mysql_free_result($res);

?>
</ul>
</p>

<p>
Poslední záznam:
<?php

$res = db_query("
	SELECT actions.id,employees.name,actions.date,actions.time,actions.type
	FROM actions,employees
	WHERE actions.employee=employees.id
	ORDER BY actions.id DESC LIMIT 1;
");
$row = mysql_fetch_array($res);
mysql_free_result($res);

echo $row["name"] . ", " . $row["date"] . " " . $row["time"] . ", " . $row["type"];

?>
</p>

</body>

</html>
