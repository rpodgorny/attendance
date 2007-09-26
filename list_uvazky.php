<?php require_once("auth.php"); ?>
<?php require_once("sql.php"); ?>

<?php include("header.htm"); ?>

<?php auth_header(); ?>

<div class="content">
<h1>
Výpis z databáze
</h1>
<h2>
Úvazky
</h2>

<?php

if (auth()) {
	echo "<p>";
	echo "<a href=\"form_uvazek_edit.php\">přidat nový záznam</a>";
	echo "</p>";
}

?>

<?php

print_table("uvazky,employees",
	"uvazky.id,employees.name,uvazky.since,uvazky.till,uvazky.uvazek",
	"uvazky.employee=employees.id",
	"employees.name,uvazky.since,uvazky.till",
	"id,zaměstnanec,od,do,úvazek",
	auth()? "uvazek" : "");

?>
</div>

<?php include("footer.htm"); ?>
