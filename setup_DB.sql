CREATE SCHEMA gorillachat;

USE gorillachat;

CREATE TABLE messages (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  mykey VARCHAR(45) NOT NULL,
  value TEXT NOT NULL,
  PRIMARY KEY (id)
);
