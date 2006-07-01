<?php require_once("auth.php"); ?>
<?php require_once("sql.php"); ?>

<?php include("header.htm"); ?>

<?php auth_header(); ?>

<div class="content">
<h1>
Výpis z databáze
</h1>
<h2>
Přesčasy
</h2>

<?php

if (auth()) {
	echo "<p>";
	echo "<a href=\"form_overtime_edit.php\">přidat nový záznam</a>";
	echo "</p>";
}

?>

<?php

print_table("overtimes,employees",
	"overtimes.id,date,employees.name,time",
	"overtimes.employee=employees.id",
	"date",
	"id,datum,zaměstnanec,délka",
	auth()? "overtime" : "");

?>
</div>

<?php include("footer.htm"); ?>
