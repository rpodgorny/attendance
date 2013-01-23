<?php require_once("sql.php"); ?>

<?php include("header.htm"); ?>

<p>
<?php

print_table("vacancies",
	"id,date",
	"id='" . $_GET["id"] . "'",
	"",
	"id,date",
	"");

?>
</p>

<p>
Opravdu smazat?
</p>

<p>
<a href="vacancy_delete.php?id=<?php echo $_GET["id"]; ?>&goto=-2">ANO</a>
</p>

<?php include("footer.htm"); ?>
