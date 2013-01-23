<?php require_once("auth.php"); ?>
<?php require_once("sql.php"); ?>

<?php include("header.htm"); ?>

<?php auth_header(); ?>

<div class="content">
<h1>
Výpis z databáze
</h1>
<h2>
Diety
</h2>

<?php

if (auth()) {
	echo "<p>";
	echo "<a href=\"form_diety_edit.php\">přidat nový záznam</a>";
	echo "</p>";
}

?>

<?php

print_table("diety,employees",
	"diety.id,date,employees.name,amount",
	"diety.employee=employees.id",
	"date desc",
	"id,datum,zaměstnanec,částka",
	auth()? "diety" : "");

?>
</div>

<?php include("footer.htm"); ?>
