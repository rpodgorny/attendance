<?php

$db_host = getenv('DB_HOST');
$db_name = 'attendance';
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASSWORD');
$sql = pg_connect('host=' . $db_host . ' dbname=' . $db_name . ' user=' . $db_user . ' password=' . $db_pass);

function db_query($query) {
	//print $query;

	return pg_query($query);
}

function db_get($table, $col, $id) {
	$val = "";

	$res = db_query("SELECT " . $col . " FROM " . $table . " WHERE id='" . $id . "';");
	$row = pg_fetch_array($res);
	if ($row) $val = $row[$col];
	pg_free_result($res);

	return $val;
}

function db_get_condition($table, $col, $cond) {
	$val = "";

	$res = db_query("SELECT " . $col . " FROM " . $table . " WHERE " . $cond . ";");
	$row = pg_fetch_array($res);
	if ($row) $val = $row[$col];
	pg_free_result($res);

	return $val;
}

function db_get_many($table, $col, $where = "", $order = "") {
	$ret = "";

	if (strlen($where) > 0) $where = " WHERE " . $where;
	if (strlen($order) > 0) $order = " ORDER BY " . $order;

	$res = db_query("SELECT " . $col . " FROM " . $table . $where . $order . ";");
	$i = 0;
	while ($row = pg_fetch_array($res)) {
		$ret[$i++] = $row[$col];
	}
	pg_free_result($res);

	return $ret;
}

function print_table($table, $columns, $condition, $order, $labels, $link) {
        if (strlen($condition)) $condition = "WHERE " . $condition;
        if (strlen($order)) $order = "ORDER BY " . $order;

        $res = db_query("SELECT " . $columns . " FROM " . $table . " " . $condition . " " . $order . ";");
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
        while ($row = pg_fetch_array($res)) {
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
	                echo "<a href=\"form_" . $link . "_edit.php?from_id=" . $row["id"] . "\">(+)</a>";
        	        echo "</td>";
		}
		echo "\n";

                echo "</tr>";
        }
        pg_free_result($res);

        echo "</table>";
}

?>
