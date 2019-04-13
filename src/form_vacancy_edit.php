<?php require_once("sql.php"); ?>

<?php

if ($_GET["from_id"]) {
	$date = db_get("vacancies", "date", $_GET["from_id"]);
} else {
	$date = date("Y-m-d");
}

?>

<?php include("header.htm"); ?>

<form action="vacancy_edit.php" method="GET">

<input type="hidden" name="goto" value="-2">

<input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">

<p>
Datum svátku (yyyy-mm-dd):
<input type="text" name="date" value="<?php echo $date; ?>"/>
</p>

<p>
<input type="submit">
</p>

</form>

<?php include("footer.htm"); ?>
