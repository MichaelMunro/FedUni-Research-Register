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
    middle_name VARCHAR(40),
    last_name VARCHAR(40) NOT NULL,
    email VARCHAR(100),
    address VARCHAR(100) ,
    phone_number VARCHAR(13),
    password VARCHAR(255) NOT NULL,
    day_dob INT,
    month_dob VARCHAR(15),
    year_dob INT NOT NULL,
   -- permisison can be (0) for standard (1) for admin (2) for super admin
    permission INT NOT NULL
);

-- I'm assuming that many users can have multiple degrees and degrees can have multiple users and grees can have multiple majors and minors--
CREATE TABLE Qualification
(
    qualification_id INT PRIMARY KEY AUTO_INCREMENT,
    qualification_type VARCHAR(100),
    qualification_name VARCHAR(100) NOT NULL,
    end_date VARCHAR(15),
    finished int,
    Uni VARCHAR(100)

);

CREATE TABLE Study
(
    user_id INT,
    qualification_id INT,
    PRIMARY KEY(user_id,qualification_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (qualification_id) REFERENCES Qualification(qualification_id)

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
    skill_type VARCHAR(100)
);



CREATE TABLE User_Skills
(
    user_id INT,
    skill_id INT,
    skill_level VARCHAR(10),
    PRIMARY KEY(user_id,skill_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (skill_id) REFERENCES Skills(skill_id)
);

INSERT INTO Skills(skill_name,skill_type) VALUES

    ("Use of normal Microsoft range of programs","General"),
    ("Written English","General"),
    ("Spoken English","General"),
    ("Organising Meetings","General"),
    ("Dealing with external stakeholders","General"),
    ("Managing Work Tasks","General"),
    ("Project Management","General"),

    ("Preparing Ethics Applications","Research"),
    ("Literature Searches","Research"),
    ("Writing Literature Reviews","Research"),
    ("Referencing Skills","Research"),
    ("Contributing to the writing of papers","Research"),
    ("Contributing to the preparation of presentations","Research"),
    ("Contributing to the preparation of reports","Research"),
    ("Assisting with grant applications","Research"),
    ("Maintaining accurate project records","Research"),
    ("Keeping Project Budget Records","Research"),
    ("Taking notes and writing minutes from project meetings","Research"),
    ("Recruiting participants","Research"),
    ("Interviewing face to face","Research"),
    ("Interviewing by phone","Research"),
    ("Survey Design and Development","Research"),
    ("Preparing on-line surveys","Research"),
    ("Data Analysis-Qualitative","Research"),
    ("Data Analysis-Quantitative","Research"),

    ("Systematic Reviews of Literature","Psychology"),
    ("Manuscript Drifting","Psychology"),
    ("Participant Recruitment","Psychology"),
    ("Psychology lab skills","Psychology"),
    ("Therapy Work","Psychology"),
    ("Other","Psychology"),

        ("Java Programming","Information Technology"),
    ("Networking","Information Technology"),
    ("Games Design","Information Technology");



