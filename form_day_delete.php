<?php require_once("sql.php"); ?>

<?php include("header.htm"); ?>


<p>
<?php

print_table("days,employees",
	"days.id,date,employees.name,type",
	"days.employee=employees.id AND days.id='" . $_GET["id"] . "'",
	"",
	"id,date,employee,type",
	"");

?>
</p>

<p>
Opravdu smazat?
</p>

<p>
<a href="day_delete.php?id=<?php echo $_GET["id"]; ?>&goto=-2">ANO</a>
</p>

<?php include("footer.htm"); ?>
