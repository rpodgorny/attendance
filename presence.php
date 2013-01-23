/// DODELAT

<?php require_once("auth.php"); ?>
<?php require_once("sql.php"); ?>
<?php require_once("datetime.php"); ?>
<?php require_once("totals.php"); ?>

<?php include("header.htm"); ?>

<?php auth_header(); ?>

<h1>
Kdo je kde
</h1>

<p>
<?php

for ($day = 1; checkdate($_GET["month"], $day, $_GET["year"]); $day++) {
	$dt = day_totals($_GET["year"], $_GET["month"], $day, $_GET["employee"]);

	if ($dt["diety_kc"] == 0) continue;

	echo "<tr>";

	echo "<td>" . $day . ".</td>";
	echo "<td>" . $dt["comment_text"] . "</td>";
	echo "<td>" . $dt["diety_kc"] . "</td>";


	echo "</tr>";
	echo "\n";
}

?>
</table>
</p>

<?php include("footer.htm"); ?>
