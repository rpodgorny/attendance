<?php require_once("sql.php"); ?>

<?php include("header.htm"); ?>

<p>
<?php

print_table("dovolene,employees",
	"dovolene.id,dovolene.year,employees.name,dovolene.days",
	"dovolene.employee=employees.id AND dovolene.id='" . $_GET["id"] . "'",
	"",
	"id,year,employee,days",
	"");

?>
</p>

<p>
Opravdu smazat?
</p>

<p>
<a href="dovolene_delete.php?id=<?php echo $_GET["id"]; ?>">ANO</a>
</p>

<?php include("footer.htm"); ?>
