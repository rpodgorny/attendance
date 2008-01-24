<?php require_once("sql.php"); ?>

<?php

$res = mysql_query("DELETE FROM actions WHERE id='" . $_GET["id"] . "';");

?>

<?php include("header.htm"); ?>

<?php

if ($res)
	echo "V pořádku.";
else
	echo "CHYBA!!!";

?>

<script language="javascript"><!--
history.go(-2)
//-->
</script>

<?php include("footer.htm"); ?>
