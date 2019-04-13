<?php require_once("auth.php"); ?>
<?php require_once("sql.php"); ?>

<?php include("header.htm"); ?>

<?php auth_header(); ?>

<div class="content">
<h1>
Výpis z databáze
</h1>
<h2>
Komentáře
</h2>

<?php

if (auth()) {
	echo "<p>";
	echo "<a href=\"form_comment_edit.php\">přidat nový záznam</a>";
	echo "</p>";
}

?>

<?php

print_table("comments,employees",
	"comments.id,date,employees.name,text",
	"comments.employee=employees.id",
	"date desc",
	"id,datum,zaměstnanec,poznámka",
	auth()? "comment" : "");

?>
</div>

<?php include("footer.htm"); ?>
