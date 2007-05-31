<?php require_once("sql.php"); ?>

<?php include("header.htm"); ?>

<p>
<?php

print_table("employees",
	"id,name,since,plusminus,dovolene,uvazek,active",
	"id='" . $_GET["id"] . "'",
	"name",
	"id,name,since,plusminus,dovolene,uvazek,active",
	"");

?>
</p>

<p>
<?php

print_table("actions,employees",
	"actions.id,date,time,employees.name,type",
	"actions.employee=employees.id AND employee='" . $_GET["id"] . "'",
	"date,time",
	"id,date,time,employee,type",
	"");

?>
</p>

<p>
<?php

print_table("days,employees",
	"days.id,date,employees.name,type",
	"days.employee=employees.id AND employee='" . $_GET["id"] . "'",
	"date",
	"id,date,employee,type",
	"");

?>
</p>

<p>
<?php

print_table("comments,employees",
	"comments.id,date,employees.name,text",
	"comments.employee=employees.id AND employee='" . $_GET["id"] . "'",
	"date",
	"id,date,employee,text",
	"");

?>
</p>

<p>
<?php

print_table("overtimes,employees",
	"overtimes.id,date,employees.name,time",
	"overtimes.employee=employees.id AND employee='" . $_GET["id"] . "'",
	"date",
	"id,date,employee,time",
	"");

?>
</p>

<p>
TODO: vypis z tabulky "dovolene"
</p>

<p>
Opravdu smazat?
</p>

<p>
<a href="employee_delete.php?id=<?php echo $_GET["id"]; ?>">ANO</a>
</p>

<?php include("footer.htm"); ?>
