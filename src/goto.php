<?php

function handle_goto_head($goto) {
	if (strlen($goto) && strpos($goto, "-") !== 0) {
		echo "<meta http-equiv=\"refresh\" content=\"0; url=" . $goto . "\">";
	}
}

function handle_goto_body($goto) {
	if (strlen($goto) && strpos($goto, "-") === 0) {
		echo "<script language=\"javascript\"><!--\n";
		echo "history.go(" . $goto . ")\n";
		echo "//--></script>";
	}
}

?>
