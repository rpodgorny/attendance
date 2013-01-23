<?php require_once("auth.php"); ?>
<?php require_once("sql.php"); ?>

<?php include("header.htm"); ?>
<?php auth_header(); ?>
<?php include("menu.htm"); ?>

<div class="selection">
<form action="stravenky.php" method="GET">
<h3>Stravenky</h3>
<p>
Rok:<br />
<input type="text" name="year" value="<?php echo date("Y"); ?>"/>
</p>

<p>
Měsíc:<br />
<input type="text" name="month" value="<?php echo date("m"); ?>"/>
</p>

<p>
<input type="submit" value="Zobrazit">
</p>
</form>
</div>

<?php include("footer.htm"); ?>
