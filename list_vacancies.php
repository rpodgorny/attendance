<?php require_once("auth.php"); ?>
<?php require_once("sql.php"); ?>

<?php include("header.htm"); ?>

<?php auth_header(); ?>

<div class="content">
<h1>
Výpis z databáze
</h1>

<h2>
Svátky
</h2>

<?php

if (auth()) {
	echo "<p>";
	echo "<a href=\"form_vacancy_edit.php\">přidat nový záznam</a>";
	echo "</p>";
}

?>

<?php

print_table("vacancies",
	"id,date",
	"",
	"date",
	"id,datum",
	auth()? "vacancy" : "");

?>
</div>

<?php include("footer.htm"); ?>
