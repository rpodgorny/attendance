<?php require_once("sql.php"); ?>

<?php include("header.htm"); ?>

<p>
<?php

print_table("uvazky,employees",
	"uvazky.id,employees.name,uvazky.since,uvazky.till,uvazky.uvazek",
	"uvazky.employee=employees.id AND uvazky.id='" . $_GET["id"] . "'",
	"",
	"id,employee,since,till,uvazek",
	"");

?>
</p>

<p>
Opravdu smazat?
</p>

<p>
<a href="uvazek_delete.php?id=<?php echo $_GET["id"]; ?>&goto=-2">ANO</a>
</p>

<?php include("footer.htm"); ?>
