CREATE DATABASE desafio_leo;

USE desafio_leo;

DROP TABLE course;

CREATE TABLE course (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(255) NOT NULL,
  description varchar(255) NOT NULL,
  backgroundImage text NOT NULL,
  redirectionUrl varchar(255) not null
);