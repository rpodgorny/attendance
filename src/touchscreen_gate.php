<?php

session_start();

if (isset($_SESSION["is_human"]) && $_SESSION["is_human"] === true) {
	header("Location: touchscreen_1.php");
	exit;
}

$error = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$answer = isset($_POST["answer"]) ? trim($_POST["answer"]) : "";
	if (isset($_SESSION["challenge_answer"]) && $answer === (string)$_SESSION["challenge_answer"]) {
		$_SESSION["is_human"] = true;
		header("Location: touchscreen_1.php");
		exit;
	}
	$error = true;
}

$a = rand(1, 20);
$b = rand(1, 20);
$_SESSION["challenge_answer"] = $a + $b;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="cs" xml:lang="cs">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta name="googlebot" content="noindex" />
	<title>
		Docházkový systém
	</title>
	<link rel="stylesheet" type="text/css" charset="utf-8" media="all" href="touchscreen.css" />
</head>

<body>

<p>Pro pokračování vyřešte úlohu:</p>

<p style="font-size: 40px;"><?php echo $a; ?> + <?php echo $b; ?> = ?</p>

<?php if ($error): ?>
<p style="color: red;">Špatná odpověď, zkuste to znovu.</p>
<?php endif; ?>

<form method="post" action="touchscreen_gate.php">
<p>
	<input type="number" name="answer" style="font-size: 30px; width: 150px; text-align: center;" autofocus="autofocus" />
</p>
<p>
	<input type="submit" value="Potvrdit" style="font-size: 30px; padding: 10px 30px; background-color: #191970; color: #daa520; border: .2em solid #daa520; font-weight: bold; cursor: pointer;" />
</p>
</form>

</body>

</html>
