<?php require_once("auth.php"); ?>
<?php require_once("sql.php"); ?>

<?php include("header.htm"); ?>

<?php auth_header(); ?>

<div class="content">
<h1>
Výpis z databáze
</h1>
<h2>
Celodenní události
</h2>

<?php

if (auth()) {
	echo "<p>";
	echo "<a href=\"form_day_edit.php\">přidat nový záznam</a>";
	echo "</p>";
}

?>

<?php

print_table("days,employees",
	"days.id,date,employees.name,type",
	"days.employee=employees.id",
	"date",
	"id,datum,zaměstnanec,typ",
	auth()? "day" : "");

?>
</div>

<?php include("footer.htm"); ?>
