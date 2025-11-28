CREATE DATABASE vktote;

CREATE TABLE IF NOT EXISTS vkgroup (
  id_group int NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  PRIMARY KEY (id_group)
);

CREATE TABLE IF NOT EXISTS post (
  id_post int NOT NULL,
  group_id int NOT NULL,
  CONSTRAINT post_ibfk FOREIGN KEY (group_id) REFERENCES vkgroup (id_group)
  ON DELETE CASCADE ON UPDATE CASCADE
);
