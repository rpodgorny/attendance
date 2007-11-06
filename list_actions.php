<?php require_once("auth.php"); ?>
<?php require_once("sql.php"); ?>

<?php include("header.htm"); ?>

<?php auth_header(); ?>

<div class="content">
<h1>
Výpis z databáze
</h1>
<h2>
Průchody
</h2>

<?php

if (auth()) {
	echo "<p>";
	echo "<a href=\"form_action_edit.php\">přidat nový záznam</a>";
	echo "</p>";
}

?>

<?php

if (strlen($_GET["employee"])) $filter .= "employee='" . $_GET["employee"] . "'";
if (strlen($_GET["date"])) {
	if (strlen($filter)) $filter .= " AND ";
	$filter .= "date='" . $_GET["date"] . "'";
}

if (strlen($filter)) $filter = " AND " . $filter;


print_table("actions,employees",
	"actions.id,date,time,employees.name,type",
	"actions.employee=employees.id" . $filter,
	"date desc,time desc",
	"id,datum,čas,zaměstnanec,typ",
	auth()? "action" : "");

?>
</div>

<?php include("footer.htm"); ?>
