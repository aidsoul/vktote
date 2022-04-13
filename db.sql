CREATE TABLE vkgroup (
  id_group int NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  PRIMARY KEY (id_group)
);

CREATE TABLE post (
  id_post int NOT NULL,
  group_id int NOT NULL,
  CONSTRAINT past_ibfk FOREIGN KEY (group_id) REFERENCES vkgroup (id_group)
);
