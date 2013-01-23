<?php require_once("auth.php"); ?>
<?php require_once("goto.php"); ?>

<?php $_SESSION["password"] = ""; ?>

<?php include("header.htm"); ?>

<?php handle_goto_body($_POST["goto"]); ?>

<p>
(snad) odhlášen
</p>

<?php include("footer.htm"); ?>
