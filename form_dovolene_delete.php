<?php require_once("sql.php"); ?>

<?php include("header.htm"); ?>

<p>
<?php

print_table("dovolene,employees",
	"dovolene.id,dovolene.year,employees.name,dovolene.days,dovolene.days_lastyear",
	"dovolene.employee=employees.id AND dovolene.id='" . $_GET["id"] . "'",
	"",
	"id,year,employee,days,days_lastyear",
	"");

?>
</p>

<p>
Opravdu smazat?
</p>

<p>
<a href="dovolene_delete.php?id=<?php echo $_GET["id"]; ?>&goto=-2">ANO</a>
</p>

<?php include("footer.htm"); ?>
