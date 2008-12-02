<?php require_once("auth.php"); ?>
<?php require_once("sql.php"); ?>
<?php require_once("datetime.php"); ?>
<?php require_once("totals.php"); ?>

<?php include("header.htm"); ?>

<?php auth_header(); ?>

<?php
	$hodnota_stravenky = 60;
	if ($_GET["year"] > 2008 || ($_GET["year"] == 2008 && $_GET["month"] >= 12)) {
		$hodnota_stravenky = 70;
	}
?>

<div class="content">
<h1>
Stravenky
</h1>

<h2>
Výdej stravenek a odečet ze mzdy za měsíc
<?php echo monthname($_GET["month"]); ?> <? echo $_GET["year"] ?>
</h2>

<table class="maxwidth">
<tr>
	<th>jméno</th>
	<th>vydat stravenek</th>
	<th>celková hodnota (<?php echo $hodnota_stravenky; ?>Kč/ks)</th>
	<th>příspěvek zaměstnance (45%)</th>
	<th>převzal</th>
</tr>
<?php

$total_vydat = 0;

$employees = db_get_many("employees", "id", "active=1 AND stravenky=1", "name");

for ($i = 0; $i < count($employees); $i++) {
	$emp = $employees[$i];

	$name = db_get("employees", "name", $emp);
	$cur_tots = month_totals($_GET["year"], $_GET["month"], $emp, false);

	$vydat = $cur_tots["stravenky"];

	$total_vydat += $vydat;


	echo "<tr>";
	echo "<td>" . $name . "</td>";
	echo "<td>" . $vydat . "</td>";
	echo "<td>" . ceil(($vydat*$hodnota_stravenky)) . "</td>";
	echo "<td>" . ceil(($vydat*$hodnota_stravenky*0.45)) . "</td>";
	echo "<td><div class=\"signature\"></div></td>";
	echo "</tr>";
}


?>
</table>

<table>
	<tr>
		<th>celkem stravenek</th>
		<td><?php echo $total_vydat; ?></td>
	</tr>
	<tr>
		<th>příspěvek zaměstnanců</th>
		<td><?php echo ceil($total_vydat*$hodnota_stravenky*0.45); ?></td>
	</tr>
</table>
</div>

<?php include("footer.htm"); ?>
