DROP DATABASE IF EXISTS FedUni_RA_Register;

CREATE DATABASE FedUni_RA_Register CHARACTER SET utf8 COLLATE utf8_general_ci;
USE FedUni_RA_Register;


GRANT SELECT, INSERT, UPDATE, DELETE
	ON FedUni_RA_Register.*
	TO 'raUser'@'localhost'
	IDENTIFIED BY 'password123';



CREATE TABLE Users
(
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(60) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
   -- permisison can be (0) for standard (1) for admin (2) for super admin
    permission INT NOT NULL
);




CREATE TABLE Major
(
    major_id INT PRIMARY KEY AUTO_INCREMENT,
    major_name VARCHAR(100) NOT NULL,
    major_description VARCHAR(250)
);

CREATE TABLE Minor
(
    minor_id INT PRIMARY KEY AUTO_INCREMENT,
    minor_name VARCHAR(100) NOT NULL,
    minor_description VARCHAR(250)
);
-- I'm assuming that many users can have multiple degrees and degrees can have multiple users and grees can have multiple majors and minors--
CREATE TABLE Degree
(
    degree_id INT PRIMARY KEY AUTO_INCREMENT,
    degree_name VARCHAR(100) NOT NULL,
    majors_id INT,
    minors_id INT,
    Uni VARCHAR(100),
    FOREIGN KEY (majors_id) REFERENCES Major(major_id),
    FOREIGN KEY (minors_id) REFERENCES Minor(minor_id)
);


CREATE TABLE Keyword
(
    keyword_id INT PRIMARY KEY AUTO_INCREMENT,
    keyword_name VARCHAR(100) NOT NULL
);

CREATE TABLE Keyword_Assignment
(
    keywords_id INT,
    users_id INT,
    PRIMARY KEY(keywords_id,users_id),
    FOREIGN KEY (users_id) REFERENCES Users(user_id),
    FOREIGN KEY (keywords_id) REFERENCES Keyword(keyword_id)
);

-- Links it all together
CREATE TABLE Profile 
(
   profile_id INT PRIMARY KEY AUTO_INCREMENT,
   degree_id INT,
   users_id INT,
   IT_Skills Boolean,
   -- Can make multiple fields
   Worked Boolean,
   FOREIGN KEY (users_id) REFERENCES Users(user_id),
   FOREIGN KEY (degree_id) REFERENCES Degree(degree_id) 
);

CREATE TABLE Message
(
    messgae_id INT PRIMARY KEY AUTO_INCREMENT,
    message_title VARCHAR(20) NOT NULL,
    message_description VARCHAR(250) NOT NULL

);

