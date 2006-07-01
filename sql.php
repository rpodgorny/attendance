<?php

$sql = mysql_connect("localhost", "root", "mimosa");
mysql_select_db("attendance");


function find_unused_id($table) {
	$id = 1;

	$res = mysql_query("SELECT MAX(id) AS id FROM " . $table . ";");
	$row = mysql_fetch_array($res);
	if ($row) $id = $row["id"] + 1;
	mysql_free_result($res);
	
	if ($id == 0) $id = 1;

	return $id;
}

function db_get($table, $col, $id) {
	$val = "";

	$res = mysql_query("SELECT " . $col . " FROM " . $table . " WHERE id='" . $id . "';");
	$row = mysql_fetch_array($res);
	if ($row) $val = $row[$col];
	mysql_free_result($res);

	return $val;
}

function db_get_condition($table, $col, $cond) {
	$val = "";

	$res = mysql_query("SELECT " . $col . " FROM " . $table . " WHERE " . $cond . ";");
	$row = mysql_fetch_array($res);
	if ($row) $val = $row[$col];
	mysql_free_result($res);

	return $val;
}

function db_get_many($table, $col, $where = "", $order = "") {
	$ret = "";

	if (strlen($where) > 0) $where = " WHERE " . $where;
	if (strlen($order) > 0) $order = " ORDER BY " . $order;

	$res = mysql_query("SELECT " . $col . " FROM " . $table . $where . $order . ";");
	$i = 0;
	while ($row = mysql_fetch_array($res)) {
		$ret[$i++] = $row[$col];
	}
	mysql_free_result($res);

	return $ret;
}

function print_table($table, $columns, $condition, $order, $labels, $link) {
        if (strlen($condition)) $condition = "WHERE " . $condition;
        if (strlen($order)) $order = "ORDER BY " . $order;

        $res = mysql_query("SELECT " . $columns . " FROM " . $table . " " . $condition . " " . $order . ";");
        if (!$res) return;

        $cols = explode(",", $columns);
        $labs = explode(",", $labels);

        echo "<table>";
        echo "<tr>";
        for ($i = 0; $i < count($labs); $i++) {
                echo "<th>" . $labs[$i] . "</th>";
        }
	if (strlen($link)) echo "<th></th>";
        echo "</tr>";

        $oddeven = 0;
        while ($row = mysql_fetch_array($res)) {
                echo ($oddeven++ % 2)? "<tr class=\"odd\">" : "<tr class=\"even\">";

                for ($i = 0; $i < count($cols); $i++) {
                        echo "<td>" . $row[$i] . "</td>";
                }

		if (strlen($link)) {
	                echo "<td>";
	                echo "<a href=\"form_" . $link . "_edit.php?from_id=" . $row["id"] . "&id=" . $row["id"] . "\">(*)</a>";
	                echo "&nbsp;";
	                echo "<a href=\"form_" . $link . "_delete.php?id=" . $row["id"] . "\">(-)</a>";
	                echo "&nbsp;";
	                echo "<a href=\"form_" . $link . "_edit.php?from_id=" . $row["id"] . "\">kopírovat</a>";
        	        echo "</td>";
		}
		echo "\n";

                echo "</tr>";
        }
        mysql_free_result($res);

        echo "</table>";
}

?>
