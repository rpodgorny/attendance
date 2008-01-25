<?php require_once("sql.php"); ?>

<?php include("header.htm"); ?>

<p>
<?php

print_table("actions,employees",
	"actions.id,date,time,employees.name,type",
	"actions.employee=employees.id AND actions.id='" . $_GET["id"] . "'",
	"",
	"id,date,time,employee,type",
	"");

?>
</p>

<p>
Opravdu smazat?
</p>

<p>
<a href="action_delete.php?id=<?php echo $_GET["id"]; ?>&goto=-2">ANO</a>
</p>

<?php include("footer.htm"); ?>
