<?php require_once("sql.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="cs" xml:lang="cs">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta name="googlebot" content="noindex" />
	<title>
		Docházkový systém
	</title>
	<link rel="stylesheet" type="text/css" charset="utf-8" media="all" href="touchscreen.css" />

	<meta http-equiv="refresh" content="60; url=touchscreen_1.php">
</head>

<body>

<p>
<?php

$employeename = db_get("employees", "name", $_GET["employee"]);

echo $employeename;

?>
</p>

<p>
<div>
<ul class="buttons">
<?php
	$types_str = "prichod,odchod,odchod-obed,odchod-lekar,odchod-sluzebne-praha,odchod-sluzebne-mimopraha";
	$labels_str = "Příchod (odkudkoliv),Odchod,Oběd (odchod),Lékař (odchod),Služebně Praha (odchod),Služebně mimo Prahu (odchod)";
	$types = explode(",", $types_str);
	$labels = explode(",", $labels_str);

	for ($i = 0; $i < count($types); $i++) {
		echo "<li>";
		echo "<a href=\"action_edit.php?employee=" . $_GET["employee"] . "&type=" . $types[$i] . "&goto=touchscreen_1.php\">" . $labels[$i] . "</a>";
		echo "</li>";
		echo "\n";
	}
?>
</ul>
</div>
</p>

<p>
<ul class="buttons-back">
<li><a href="touchscreen_1.php">Zpět</a></li>
</ul>
</p>

</body>

</html>
