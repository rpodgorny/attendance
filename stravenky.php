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
Výdej za měsíc
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
	$cur_tots = month_totals($_GET["year"], $_GET["month"], $emp, false);


	$odpocet = $cur_tots_noemployee["stravenky"] - $cur_tots["stravenky"];
	$vydat = $cur_tots["stravenky"];

	$total_vydat += $vydat;


	echo "<tr>";
	echo "<td>" . $name . "</td>";
	echo "<td>" . $cur_tots_noemployee["stravenky"] . "</td>";
	echo "<td>" . $odpocet . "</td>";
	echo "<td>" . $vydat . "</td>";
	echo "<td>" . ($vydat*60) . "</td>";
	echo "<td>" . ($vydat*60*0.45) . "</td>";
	echo "<td><div class=\"signature\"></div></td>";
	echo "</tr>";
}

// Prodavaj se v paklech po dvaceti
while ($total_vydat % 20) $total_vydat++;

?>
</table>

<table>
	<tr>
		<th>celkem stravenek</th>
		<td><?php echo $total_vydat; ?></td>
	</tr>
	<tr>
		<th>cena za stravenky (po 60,- Kc)</th>
		<td><?php echo $total_vydat*60; ?></td>
	</tr>
	<tr>
		<th>provize 2.8%</th>
		<td><?php echo $total_vydat*60*0.028; ?></td>
	</tr>
	<tr>
		<th>DPH z provize (19%)</th>
		<td><?php echo $total_vydat*60*0.028*0.19; ?></td>
	</tr>
	<tr>
		<th>CELKEM</th>
		<td><?php echo $total_vydat*60 * (1 + 0.028 + 0.028*0.19); ?></td>
	</tr>
</table>
</div>

<?php include("footer.htm"); ?>
