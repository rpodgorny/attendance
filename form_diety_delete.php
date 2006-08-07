<?php require_once("sql.php"); ?>

<?php include("header.htm"); ?>

<p>
<?php

print_table("diety,employees",
	"diety.id,date,employees.name,amount",
	"diety.employee=employees.id AND diety.id='" . $_GET["id"] . "'",
	"",
	"id,date,employee,amount",
	"");

?>
</p>

<p>
Opravdu smazat?
</p>

<p>
<a href="diety_delete.php?id=<?php echo $_GET["id"]; ?>">ANO</a>
</p>

<?php include("footer.htm"); ?>
