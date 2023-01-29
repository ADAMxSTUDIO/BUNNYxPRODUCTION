USE Master;
GO;
CREATE DATABASE bunnyxproduction;
GO;
USE bunnyxproduction;
GO;
-- ######## USERS TABLE ########
CREATE TABLE users(
    id int IDENTITY(1,1) NOT NULL,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL,
    c_date datetime NOT NULL,
    CONSTRAINT PK_id PRIMARY KEY (id)
);
GO;
ALTER TABLE users;
GO;
ADD COLUMN picture text NULL AFTER c_date;
GO;
-- ##################################
-- ########## FOUNDERS TABLE ##########
CREATE TABLE Founders(
    id int IDENTITY(1,1) NOT NULL UNIQUE,
    name TEXT NOT NULL,
    about TEXT NOT NULL DEFAULT 'ADAM, Web Master, now studying Web developement, Software engeneering & DataBase Managment in the 1<sup>st </sup> year of college',
    pic TEXT NOT NULL
);
GO;
-- #####################################
-- ######## HEADPHONES TABLE ########
CREATE TABLE Headphones(
    id int IDENTITY(1,1) NOT NULL UNIQUE,
    discount percentage,
    img text NOT NULL,
    label text NOT NULL,
    description text,
    price float NOT NULL,
    CONSTRAINT PK_Headphones PRIMARY KEY (id)
);
GO;
-- ####################################
-- ########### CHAIRS TABLE ###########
CREATE TABLE Chairs(
    id int IDENTITY(1,1) NOT NULL UNIQUE,
    discount percentage,
    img text NOT NULL,
    label text NOT NULL,
    description text,
    price float NOT NULL,
    CONSTRAINT PK_Chairs PRIMARY KEY (id)
);
GO;
-- ####################################



-- ################## PhpMyAdmin ##################

-- CREATE DATABASE bunnyxproduction;
-- USE bunnyxproduction;
-- CREATE TABLE Headphones(
--     id int AUTO_INCREMENT,
--     discount int,
--     img text NOT NULL,
--     label text NOT NULL,
--     description text,
--     price float NOT NULL,
--     CONSTRAINT PK_Headphones PRIMARY KEY (id)
-- );