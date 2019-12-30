-- TODO: convert active and stravenky to BOOL? is it worth the 1/0 to t/f refactoring?
CREATE TABLE employees(
	id SERIAL PRIMARY KEY,
	name TEXT,
	plusminus INTERVAL,
	dovolene INT,
	active INT,
	stravenky INT
);

CREATE TYPE actions_enum AS ENUM('prichod', 'odchod', 'odchod-obed', 'odchod-sluzebne-praha', 'odchod-sluzebne-mimopraha', 'odchod-lekar');

-- TODO: fix time type
CREATE TABLE actions(
	id SERIAL PRIMARY KEY,
	employee INT REFERENCES employees(id),
	type actions_enum,
	date DATE,
	time INTERVAL,
	datetime TIMESTAMP,
	UNIQUE(employee,date,time);
);
CREATE INDEX ON actions(employee);
CREATE INDEX ON actions(date);
CREATE INDEX ON actions(time);
CREATE INDEX ON actions(datetime);
CREATE INDEX ON actions(date, time);

CREATE TABLE action_type(
	id SERIAL PRIMARY KEY,
	name TEXT,
	icon TEXT
);

-- TODO: fix time type?
CREATE TABLE overtimes(
	id SERIAL PRIMARY KEY,
	date DATE,
	employee INT REFERENCES employees(id),
	time INTERVAL
);
CREATE INDEX ON overtimes(date);
CREATE INDEX ON overtimes(employee);

CREATE TABLE comments(
	id SERIAL PRIMARY KEY,
	date DATE,
	employee INT REFERENCES employees(id),
	text TEXT
);
CREATE INDEX ON comments(date);
CREATE INDEX ON comments(employee);

CREATE TABLE vacancies(
	id SERIAL PRIMARY KEY,
	date DATE
);
CREATE INDEX ON vacancies(date);

CREATE TYPE days_enum AS ENUM('nemoc', 'dovolena', 'nahrada', 'neplacene_volno');

CREATE TABLE days(
	id SERIAL PRIMARY KEY,
	date DATE,
	employee INT REFERENCES employees(id),
	type days_enum
);
CREATE INDEX ON days(date);
CREATE INDEX ON days(employee);

CREATE TABLE dovolene(
	id SERIAL PRIMARY KEY,
	year INT,
	employee INT REFERENCES employees(id),
	days INT,
	days_lastyear INT
);
CREATE INDEX ON dovolene(year);
CREATE INDEX ON dovolene(employee);

CREATE TABLE diety(
	id SERIAL PRIMARY KEY,
	date DATE,
	employee INT REFERENCES employees(id),
	amount INT
);
CREATE INDEX ON diety(date);
CREATE INDEX ON diety(employee);

CREATE TABLE uvazky(
	id SERIAL PRIMARY KEY,
	employee INT REFERENCES employees(id),
	since DATE,
	till DATE,
	uvazek INT
);
CREATE INDEX ON uvazky(employee);
CREATE INDEX ON uvazky(since);
CREATE INDEX ON uvazky(till);

CREATE TABLE cache_day_totals(
	id SERIAL PRIMARY KEY,
	date DATE,
	employee INT REFERENCES employees(id),
	odpracovano INT,
	stravenky NUMERIC,
	diety_id INT,
	diety_kc INT,
	daylog TEXT,
	plusminus INT,
	status_id INT,
	status_type TEXT,
	comment_id INT,
	comment_text TEXT,
	overtime_id INT,
	overtime_time INT,
	error INT
);
CREATE INDEX ON cache_day_totals(employee);
CREATE INDEX ON cache_day_totals(date);
CREATE INDEX ON cache_day_totals(employee, date);

CREATE TABLE cache_month_totals(
	id SERIAL PRIMARY KEY,
	year INT,
	month INT,
	employee INT REFERENCES employees(id),
	odpracovano INT,
	plusminus INT,
	overtime INT,
	days_nemoc INT,
	days_dovolena INT,
	stravenky NUMERIC,
	diety_kc INT,
	error INT
);
CREATE INDEX ON cache_month_totals(employee);
CREATE INDEX ON cache_month_totals(year, month);
CREATE INDEX ON cache_month_totals(employee, year, month);
