<?php require_once("auth.php"); ?>
<?php require_once("sql.php"); ?>
<?php require_once("datetime.php"); ?>
<?php require_once("totals.php"); ?>

<?php include("header.htm"); ?>

<?php auth_header(); ?>

<div class="content">
<h1>
Cestovní příkaz
</h1>

<h2>
<?php
$employeename = db_get("employees", "name", $_GET["employee"]);
echo $employeename;
?>
 -
<?php echo monthname($_GET["month"]) . " " . $_GET["year"]; ?>
</h2>

<table>
<tr>
	<th>datum</th>
	<th>odjezd/příjezd</th>
	<th>stravné</th>
</tr>

<?php

$total = 0;

for ($day = 1; checkdate($_GET["month"], $day, $_GET["year"]); $day++) {
	$dt = day_totals($_GET["year"], $_GET["month"], $day, $_GET["employee"]);

	if ($dt["diety_kc"] == 0) continue;

	$total += $dt["diety_kc"];


	echo "<tr>";

	echo "<td>" . $day . "." . $_GET["month"] . ". " . $_GET["year"] . "</td>";
	echo "<td>" . $dt["comment_text"] . "</td>";
	echo "<td>" . $dt["diety_kc"] . "</td>";


	echo "</tr>";
	echo "\n";
}

?>
</table>

<table>
	<tr>
		<th>celkem</th>
		<td><?php echo $total; ?></td>
	</tr>
</table>
</div>

<?php include("footer.htm"); ?>
