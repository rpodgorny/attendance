<?php require_once("auth.php"); ?>
<?php require_once("sql.php"); ?>
<?php require_once("datetime.php"); ?>
<?php require_once("totals.php"); ?>

<?php

$cur_tots_noemployee = month_totals($_GET["year"], $_GET["month"], 0, false);

?>


<?php include("header.htm"); ?>

<?php auth_header(); ?>

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
	<th>nárok stravenek</th>
	<th>odpočet stravenek</th>
	<th>vydat stravenek</th>
	<th>celková hodnota (60Kč/ks)</th>
	<th>příspěvek zaměstnance (45%)</th>
	<th>převzal</th>
</tr>
<?php

$total_vydat = 0;

$employees = db_get_many("employees", "id", "active=1 AND stravenky=1", "name");

for ($i = 0; $i < count($employees); $i++) {
	$emp = $employees[$i];

	$name = db_get("employees", "name", $emp);
	$ratio = db_get("employees", "uvazek", $emp) / 8.0;
	$cur_tots = month_totals($_GET["year"], $_GET["month"], $emp, false);


	$odpocet = ($cur_tots_noemployee["stravenky"] - $cur_tots["stravenky"]) * $ratio;
	$vydat = $cur_tots["stravenky"] * $ratio;

	$total_vydat += $vydat;


	echo "<tr>";
	echo "<td>" . $name . "</td>";
	echo "<td>" . $cur_tots_noemployee["stravenky"] * $ratio . "</td>";
	echo "<td>" . $odpocet . "</td>";
	echo "<td>" . $vydat . "</td>";
	echo "<td>" . ceil(($vydat*60)) . "</td>";
	echo "<td>" . ceil(($vydat*60*0.45)) . "</td>";
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
		<td><?php echo ceil($total_vydat*60*0.45); ?></td>
	</tr>
</table>
</div>

<?php include("footer.htm"); ?>
