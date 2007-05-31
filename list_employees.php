<?php require_once("auth.php"); ?>
<?php require_once("sql.php"); ?>

<?php include("header.htm"); ?>

<?php auth_header(); ?>

<div class="content">
<h1>
Výpis z databáze
</h1>

<h2>
Zaměstnanci
</h2>

<?php

if (auth()) {
	echo "<p>";
	echo "<a href=\"form_employee_edit.php\">přidat nový záznam</a>";
	echo "</p>";
}

?>

<?php

print_table("employees",
	"id,name,since,plusminus,dovolene,active,stravenky,uvazek",
	"",
	"name",
	"id,jméno,založen,+/-,dovolené,aktivní,stravenky,uvazek",
	auth()? "employee" : "");

?>
</div>

<?php include("footer.htm"); ?>
