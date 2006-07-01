<?php require_once("sql.php"); ?>

<?php

$date = db_get("comments", "date", $_GET["id"]);
$employee = db_get("comments", "employee", $_GET["id"]);
$text = db_get("comments", "text", $_GET["id"]);

$employee_name = db_get("employees", "name", $employee);

?>

<?php include("header.htm"); ?>

<p>
Opravdu smazat?
</p>

<table>
<tr>
	<th>id</th><th>datum</th><th>zaměstnanec</th><th>poznámka</th>
</tr>
<tr>
	<td><?php echo $_GET["id"]; ?></td>
	<td><?php echo $date; ?></td>
	<td><?php echo $employee_name; ?></td>
	<td><?php echo $text; ?></td>
</tr>
</table>

<p>
<a href="comment_delete.php?id=<?php echo $_GET["id"]; ?>">ANO</a>
</p>

<?php include("footer.htm"); ?>
