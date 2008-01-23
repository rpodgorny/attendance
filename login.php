<?php require_once("auth.php"); ?>

<?php

$_SESSION["password"] = $_POST["password"];

?>

<?php include("header.htm"); ?>

<script language="javascript"><!--
history.back()
//-->
</script>

<p>
Přihlášen
</p>

<?php include("footer.htm"); ?>
