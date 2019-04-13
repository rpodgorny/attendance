<?php require_once("auth.php"); ?>
<?php require_once("sql.php"); ?>

<?php include("header.htm"); ?>

<?php auth_header(); ?>

<div class="content">
<h1>
Výpis z databáze
</h1>
<h2>
Dovolené
</h2>

<?php

if (auth()) {
	echo "<p>";
	echo "<a href=\"form_dovolene_edit.php\">přidat nový záznam</a>";
	echo "</p>";
}

?>

<?php

print_table("dovolene,employees",
	"dovolene.id,year,employees.name,days,days_lastyear",
	"dovolene.employee=employees.id",
	"year,employees.name",
	"id,rok,zaměstnanec,dnů,dnů z minulého roku",
	auth()? "dovolene" : "");

?>
</div>

<?php include("footer.htm"); ?>
