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
    title VARCHAR(5) NOT NULL, -- Mr/Mrs/Miss/Dr etc.
    first_name VARCHAR(20) NOT NULL,
    middle_name VARCHAR(40) NOT NULL,
    last_name VARCHAR(40) NOT NULL,
    email VARCHAR(100) NOT NULL,
    address VARCHAR(100) NOT NULL,
    phone_number VARCHAR(13) NOT NULL,
    password VARCHAR(255) NOT NULL,
    day_dob INT NOT NULL,
    month_dob VARCHAR(15) NOT NULL,
    year_dob INT NOT NULL,
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
CREATE TABLE Qualification
(
    qualification_id INT PRIMARY KEY AUTO_INCREMENT,
    qualification_name VARCHAR(100) NOT NULL,
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
CREATE TABLE Employment
(
    employment_id INT PRIMARY KEY AUTO_INCREMENT,
    organisation VARCHAR(50),
    position_type VARCHAR(50),
    startDate DATETIME,
    endDate DATETIME,
    tasks VARCHAR(250)

);

CREATE TABLE Fed_Employment
(
    fed_employment_id INT PRIMARY KEY AUTO_INCREMENT,
    manager VARCHAR(50),
    phone_number VARCHAR(13) NOT NULL,
    position_type VARCHAR(50),
    startDate DATETIME,
    endDate DATETIME,
    tasks VARCHAR(250)
);
CREATE TABLE files
(
    file_id INT PRIMARY KEY AUTO_INCREMENT,
    file_name VARCHAR(100) NOT NULL,
    file_location VARCHAR(200) NOT NULL,
    file_size INT NOT NULL
);
-- Links it all together
CREATE TABLE Profiles 
(
   profile_id INT PRIMARY KEY AUTO_INCREMENT,
   qualification_id INT,
   users_id INT,
   employment_id INT,
   fed_employment_id INT,
   file_id INT,
   FOREIGN KEY (users_id) REFERENCES Users(user_id),
   FOREIGN KEY (qualification_id) REFERENCES Qualification(qualification_id), 
   FOREIGN KEY (employment_id) REFERENCES Employment(employment_id),
   FOREIGN KEY (fed_employment_id) REFERENCES Fed_Employment(fed_employment_id),
   FOREIGN Key (file_id) REFERENCES files(file_id)

);


CREATE TABLE Messages
(
    message_id INT PRIMARY KEY AUTO_INCREMENT,
    message_title VARCHAR(20) NOT NULL,
    message_description VARCHAR(250) NOT NULL

);


CREATE TABLE Skills
(
    skill_id INT PRIMARY KEY AUTO_INCREMENT,
    skill_name VARCHAR(100) NOT NULL,
    skill_level VARCHAR(10) NOT NULL, 
    skill_type VARCHAR(20)
);



CREATE TABLE User_Skills
(
    user_id INT,
    skill_id INT,
    PRIMARY KEY(user_id,skill_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (skill_id) REFERENCES Skills(skill_id)
);

INSERT INTO Skills(skill_name,skill_level,skill_type) VALUES

    ("Use of normal Microsoft range of programs","Medium","General"),
    ("Written English","Low","General"),
    ("Spoken English","Medium","General"),
    ("Organising Meetings","Medium","General"),
    ("Dealing with external stakeholders","High","General"),
    ("Managing Work Tasks","Medium","General"),
    ("Project Management","Low","General"),

    ("Preparing Ethics Applications","Medium","Research"),
    ("Literature Searches","Low","Research"),
    ("Writing Literature Reviews","Medium","Research"),
    ("Referencing Skills","Medium","Research"),
    ("Contributing to the writing of papers","High","Research"),
    ("Contributing to the preparation of presentations","Medium","Research"),
    ("Contributing to the preparation of reports","High","Research"),
    ("Assisting with grant applications","Medium","Research"),
    ("Maintaining accurate project records","Low","Research"),
    ("Keeping Project Budget Records","Medium","Research"),
    ("Taking notes and writing minutes from project meetings","Medium","Research"),
    ("Recruiting participants","High","Research"),
    ("Interviewing face to face","Medium","Research"),
    ("Interviewing by phone","Low","Research"),
    ("Survey Design and Development","Medium","Research"),
    ("Preparing on-line surveys","High","Research"),
    ("Data Analysis-Qualitative","Medium","Research"),
    ("Data Analysis-Quantitative","Low","Research"),

    ("Systematic Reviews of Literature","Low","Psychology"),
    ("Manuscript Drifting","High","Psychology"),
    ("Participant Recruitment","Medium","Psychology"),
    ("Psychology lab skills","Low","Psychology"),
    ("Therapy Work","Medium","Psychology"),
    ("Other","High","Psychology");



