<?php

session_start();


function auth_header() {
	if (auth()) {
		echo "<div class=\"menu\">\n";
			echo "<ul><li><a href=\"admin.php\">Návrat do menu</a></li></ul>\n";
		echo "</div>\n";
		echo "<div class=\"authorization\">\n";
			echo "<form action=\"logout.php\" method=\"post\">\n";
			echo "<input type=\"hidden\" name=\"goto\" value=\"-1\" />";
			echo "<p>";
				echo "<input type=\"submit\" value=\"Odhlásit se\" />";
			echo "</p>\n";
			echo "</form>\n";
		echo "</div>\n";
	} else {
		echo "<div class=\"menu\">\n";
			echo "<ul><li><a href=\"admin.php\">Návrat do menu</a></li></ul>\n";
		echo "</div>\n";
		echo "<div class=\"authorization\">\n";
			echo "<form action=\"login.php\" method=\"post\">\n";
			echo "<input type=\"hidden\" name=\"goto\" value=\"-1\" />";
			echo "<p>";
				echo "Heslo: ";
				echo "<input type=\"password\" name=\"password\" />";
				echo "<input type=\"submit\" value=\"Přihlásit se\" />";
			echo "</p>\n";
			echo "</form>\n";
		echo "</div>\n";
	}
}

function auth() {
	if ($_SESSION["password"] == "jarigo") return true;
	return false;
}

?>
