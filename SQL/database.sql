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
    permission INT NOT NULL,
    uniWork INT NOT NULL
);

INSERT INTO Users(title,first_name,middle_name,last_name,email,address,phone_number,password,day_dob,month_dob,year_dob,permission,uniWork) VALUES 
    ("Dr","Michael","Ernest","Munro","michael@test","Admin",0123441,"$2y$12$0SM7zfbupHNhD8Vu6iBCVeunUIdzdXL.6HmTsT7ZSvh3qrK/zVhsK",12,"October",1990,0,0),
    ("Dr","Admin","Admin","Admin","Admin@test","Admin",0123441,"$2y$12$0SM7zfbupHNhD8Vu6iBCVeunUIdzdXL.6HmTsT7ZSvh3qrK/zVhsK",12,"October",1990,1,0),
    ("Dr","SuperAdmin","SuperAdmin","SuperAdmin","Super@test","SuperAdmin",0123441,"$2y$12$0SM7zfbupHNhD8Vu6iBCVeunUIdzdXL.6HmTsT7ZSvh3qrK/zVhsK",12,"October",1990,2,0);
CREATE TABLE Qualification
(
    qualification_id INT PRIMARY KEY AUTO_INCREMENT,
    qualification_type VARCHAR(100),
    qualification_name VARCHAR(100) NOT NULL,
    end_date VARCHAR(15),
    finished int

);

CREATE TABLE University
(
    University_id INT PRIMARY KEY AUTO_INCREMENT,
    University_name VARCHAR(100) NOT NULL
);

INSERT INTO University(University_name) VALUES
    ("Federation University Australia"),
    ("Monash University"),
    ("Deakin University"),
    ("University of Melbourne"),
    ("Australian Catholic University"),
     ("University of Sydney");

CREATE TABLE Study
(
    user_id INT,
    qualification_id INT,
    University_id INT,
    PRIMARY KEY(user_id,qualification_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (qualification_id) REFERENCES Qualification(qualification_id),
    FOREIGN KEY (University_id) REFERENCES University(University_id)
);
CREATE TABLE Employment
(
    employment_id INT PRIMARY KEY AUTO_INCREMENT,
    work_rate VARCHAR(50),
    position_title VARCHAR(50),
    manager VARCHAR(50),
    manager_phone VARCHAR(13) NOT NULL,
    organisation VARCHAR(50),
    startDate VARCHAR(50),
    endDate VARCHAR(50),
    tasks VARCHAR(250)

);


CREATE TABLE User_Employment
(  
   user_id INT NOT NULL,
   employment_id INT NOT NULL,
   PRIMARY KEY(employment_id,user_id),
   FOREIGN KEY (user_id) REFERENCES Users(user_id),
   FOREIGN KEY (employment_id) REFERENCES Employment(employment_id)


);
CREATE TABLE files
(
    file_id INT PRIMARY KEY AUTO_INCREMENT,
    file_name VARCHAR(100) NOT NULL,
    file_location VARCHAR(200) NOT NULL,
    file_size INT NOT NULL
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

CREATE TABLE User_Files
(
   file_id INT NOT NULL,
   user_id INT NOT NULL,
   PRIMARY KEY(file_id,user_id),
   FOREIGN KEY (user_id) REFERENCES Users(user_id),
   FOREIGN KEY (file_id) REFERENCES files(file_id)
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




