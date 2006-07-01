<?php require_once("auth.php"); ?>
<?php require_once("sql.php"); ?>
<?php require_once("datetime.php"); ?>
<?php require_once("totals.php"); ?>

<?php include("header.htm"); ?>

<?php auth_header(); ?>

<div class="content">
<h1>
Uznané přesčasy
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
	<th>druh dne</th>
	<th>přesčas</th>
	<th>poznamka</th>
</tr>

<?php

$total = 0;

for ($day = 1; checkdate($_GET["month"], $day, $_GET["year"]); $day++) {
	$date = date_to_string($_GET["year"], $_GET["month"], $day);

	$time = db_get_condition("overtimes", "time", "date='".$date."' AND employee='".$_GET["employee"]."'");
	$time = datetime_to_secs($time);

	if ($time == 0) continue;

	$daytype = weekdayname($_GET["year"], $_GET["month"], $day);
	if (db_get_condition("vacancies", "date", "date='".$date."'")) {
		$daytype .= " + svatek";
	}

	$note = db_get_condition("comments", "text", "date='".$date."' AND employee='".$_GET["employee"]."'");

	$total += $time;


	echo "<tr>";

	echo "<td>" . $day . "." . $_GET["month"] . ". " . $_GET["year"] . "</td>";
	echo "<td>" . $daytype . "</td>";
	echo "<td>" . secs_to_time($time) . "</td>";
	echo "<td>" . $note . "</td>";


	echo "</tr>";
	echo "\n";
}

?>
</table>

<table>
	<tr>
		<th>celkem</th>
		<td><?php echo secs_to_time($total); ?></td>
	</tr>
</table>
</div>

<?php include("footer.htm"); ?>
