<?php require_once("common.php"); ?>
<?php require_once("sql.php"); ?>

<?php

echo "[";

$res = db_query("
	SELECT id,name
	FROM employees
	WHERE active=1
	ORDER BY name;
");

$first = 1;
while ($row = pg_fetch_array($res)) {
	$res2 = db_query("
		select type
		from actions
		where employee=" . $row["id"] . " and date<=current_date
		order by date desc,time desc limit 1;
	");
	$row2 = pg_fetch_array($res2);
	pg_free_result($res2);

	$status = '?';
	switch ($row2['type']) {
		case 'prichod': $status = 'pritomen'; break;
		case 'odchod': $status = 'nepritomen'; break;
		case 'odchod-obed': $status = 'obed'; break;
		case 'odchod-sluzebne-praha':
		case 'odchod-sluzebne-mimopraha': $status = 'sluzebni-cesta'; break;
		case 'odchod-lekar': $status = 'lekar'; break;
	}

	// now check (and possibly overwrite status with) the whole-day status
	$res2 = db_query("
		select type
		from days
		where employee=" . $row["id"] . " and date=current_date
		order by date desc limit 1;
	");
	$row2 = pg_fetch_array($res2);
	pg_free_result($res2);

	switch ($row2['type']) {
		case 'nemoc': $status = 'nemoc'; break;
		case 'dovolena': $status = 'dovolena'; break;
	}

	// TODO: what if on vacation/sick and still present? display both? (safety - in case of fire, ...)

	if (!$first) {
		echo ", ";
	}
	echo "{";
	echo "\"id\": " . $row["id"] . ", ";
	echo "\"status\": \"" . $status . "\", ";
	echo "\"name\": \"" . $row["name"] . "\"";
	echo "}";

	$first = 0;
}
pg_free_result($res);

echo "]";

?>
