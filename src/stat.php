<?php require_once("auth.php"); ?>
<?php require_once("sql.php"); ?>
<?php require_once("datetime.php"); ?>
<?php require_once("totals.php"); ?>

<?php include("header.htm"); ?>

<?php auth_header(); ?>

<div class="content">
<h1>
Výkaz odpracované doby
</h1>
<h2>
<?php
$employeename = db_get("employees", "name", $_GET["employee"]);
echo $employeename;
?>
 -
<?php echo monthname($_GET["month"]) . " " . $_GET["year"]; ?>
</h2>

<?php

$res = db_query("
	SELECT MIN(since) AS since
	FROM uvazky
	WHERE employee='" . $_GET["employee"] . "'
;");
$row = pg_fetch_array($res);
$since = $row["since"];

$date = getdate(strtotime($since));
$y = $date["year"]; $m = $date["mon"];

$prev_tots["plusminus"] = datetime_to_secs(db_get("employees", "plusminus", $_GET["employee"]));
$prev_tots["days_dovolena"] = 0;

if ($y == $_GET["year"]) $prev_tots["days_dovolena"] += db_get("employees", "dovolene", $_GET["employee"]);

while ($y*12+$m < $_GET["year"]*12+$_GET["month"]) {
	$mt = month_totals($y, $m, $_GET["employee"]);

	if ($mt["error"]) {
		echo "<p>";
		echo "Chyba v mesici " . $y . "/" . $m . "!";
		echo "</p>";
		//break;
	}

	$prev_tots["plusminus"] += $mt["plusminus"] - $mt["overtime"];
	if ($y == $_GET["year"]) $prev_tots["days_dovolena"] += $mt["days_dovolena"];

	$m++;
	if ($m > 12) {
		$y++;
		$m = 1;
	}
}

$cur_tots = month_totals($_GET["year"], $_GET["month"], $_GET["employee"]);

$dovolena_narok = db_get_condition("dovolene", "days", "employee=".$_GET["employee"]." AND year='".$_GET["year"]."'");
$dovolena_zminula = db_get_condition("dovolene", "days_lastyear", "employee=".$_GET["employee"]." AND year='".$_GET["year"]."'");

//$cur_tots_noemployee = month_totals($_GET["year"], $_GET["month"], 0);
?>

<?php month_totals_print($_GET["year"], $_GET["month"], $_GET["employee"]); ?>

<table>
	<tr>
		<th>odpracováno tento měsíc</th>
		<td><?php echo secs_to_time($cur_tots["odpracovano"]); ?></td>
	</tr>
	<tr>
		<th>uznané přesčasy</th>
		<td><?php echo secs_to_time($cur_tots["overtime"]); ?></td>
	</tr>
	<tr>
		<th>dnů nemoci</th>
		<td><?php echo $cur_tots["days_nemoc"]; ?></td>
	</tr>
	<tr>
		<th>vyplatit na dietách (bez zahraničních)</th>
		<td><?php echo $cur_tots["diety_kc"]; ?></td>
	</tr>
</table>

<table>
	<tr>
		<th>+/- z předchozích měsíců</th>
		<td><?php echo secs_to_time($prev_tots["plusminus"]); ?></td>
	</tr>
	<tr>
		<th>+/- tento měsíc</th>
		<td><?php echo secs_to_time($cur_tots["plusminus"]); ?></td>
	</tr>
	<tr>
		<th>+/- přesčasy</th>
		<td>- <?php echo secs_to_time($cur_tots["overtime"]); ?></td>
	</tr>
	<tr>
		<th>+/- celkem</th>
		<td><?php echo secs_to_time($prev_tots["plusminus"] + $cur_tots["plusminus"] - $cur_tots["overtime"]); ?></td>
	</tr>
</table>

<table>
	<tr>
		<th>přenos dovolené z minulého roku</th>
		<td><?php echo $dovolena_zminula; ?></td>
	</tr>
	<tr>
		<th>nárok na dovolenou na tento rok</th>
		<td><?php echo $dovolena_narok; ?></td>
	</tr>
	<tr>
		<th>vyčerpáno dovolené</th>
		<td><?php echo $prev_tots["days_dovolena"] + $cur_tots["days_dovolena"]; ?></td>
	</tr>
	<tr>
		<th>zbývá dnů dovolené</th>
		<td><?php echo $dovolena_narok + $dovolena_zminula - $prev_tots["days_dovolena"] - $cur_tots["days_dovolena"]; ?></td>
	</tr>
</table>

<table>
	<tr>
		<th>vydat stravenek tento měsíc</th>
		<td><?php echo $cur_tots["stravenky"]; ?></td>
	</tr>
</table>
</div>

<?php include("footer.htm"); ?>
