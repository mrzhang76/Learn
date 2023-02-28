CREATE DATABASE bookmarks;
USE bookmarks;

CREATE TABLE user(
    username VARCHAR(16) NOT NULL PRIMARY KEY,
    passwd CHAR(40) NOT NULL,
    email VARCHAR(100) NOT NULL
);

CREATE TABLE bookmark(
    username VARCHAR(16) NOT NULL,
    bm_URL VARCHAR(256) NOT NULL,
    INDEX (username),
    INDEX (bm_URL),
    PRIMARY KEY (username, bm_URL)
);

create user 'bm_user'@'localhost' identified by 'password';
grant select,insert,update,delete,index,create,drop on bookmarks.* to 'bm_user'@'localhost'; 
