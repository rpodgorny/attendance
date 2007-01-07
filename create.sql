CREATE DATABASE attendance;

GRANT SELECT,INSERT,UPDATE,DELETE,CREATE,DROP,INDEX,ALTER,CREATE TEMPORARY TABLES ON attendance.* TO "attendance"@"%";

USE attendance;

CREATE TABLE employees(
	id INT NOT NULL,
	name CHAR(255),
	since DATE,
	plusminus TIME,
	dovolene INT,
	active BOOL,
	stravenky BOOL,
	PRIMARY KEY(id)
);

CREATE TABLE actions(
	id INT NOT NULL,
	date DATE,
	time TIME,
	employee INT,
	type ENUM(
		'prichod',
		'odchod',
		'odchod-obed',
		'odchod-sluzebne-praha',
		'odchod-sluzebne-mimopraha',
		'odchod-lekar'
	),
	PRIMARY KEY(id)
);

CREATE TABLE overtimes(
	id INT NOT NULL,
	date DATE,
	employee INT,
	time TIME,
	PRIMARY KEY(id)
);

CREATE TABLE comments(
	id INT NOT NULL,
	date DATE,
	employee INT,
	text CHAR(255),
	PRIMARY KEY(id)
);

CREATE TABLE vacancies(
	id INT NOT NULL,
	date DATE,
	PRIMARY KEY(id)
);

CREATE TABLE days(
	id INT NOT NULL,
	date DATE,
	employee INT,
	type ENUM(
		'nemoc',
		'dovolena',
		'nahrada'
	),
	PRIMARY KEY(id)
);

CREATE TABLE dovolene(
	id INT NOT NULL,
	year INT,
	employee INT,
	days INT,
	PRIMARY KEY(id)
);

CREATE TABLE diety(
	id INT NOT NULL,
	date DATE,
	employee INT,
	amount INT,
	PRIMARY KEY(id)
);
