<?php require_once("sql.php"); ?>

<?php include("header.htm"); ?>

<p>
<?php

print_table("overtimes,employees",
	"overtimes.id,date,employees.name,time",
	"overtimes.employee=employees.id AND overtimes.id='" . $_GET["id"] . "'",
	"",
	"id,date,employee,time",
	"");

?>
</p>

<p>
Opravdu smazat?
</p>

<p>
<a href="overtime_delete.php?id=<?php echo $_GET["id"]; ?>">ANO</a>
</p>

<?php include("footer.htm"); ?>
