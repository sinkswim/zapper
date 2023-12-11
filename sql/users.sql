DROP DATABASE if exists zapperdb; 
CREATE DATABASE zapperdb; 
USE zapperdb;

DROP TABLE IF EXISTS users; 

CREATE TABLE users(
			 username VARCHAR(12) NOT NULL PRIMARY KEY,
			 password VARCHAR(12) NOT NULL,
			 record INTEGER DEFAULT 0
);


INSERT INTO users VALUES ('John','lennon','1000');
INSERT INTO users VALUES ('Paul','mccartney','900');
INSERT INTO users VALUES ('George','harrison','800');
INSERT INTO users VALUES ('Ringo','star123','700');
INSERT INTO users VALUES ('Roger','daltrey','600');
INSERT INTO users VALUES ('Keith','moon123','500');