CREATE DATABASE auth;

create user 'webauth'@'localhost' identified by 'webauth';
grant select,insert,update,delete,index,create,drop on auth.* to 'webauth'@'localhost';

create table authorized_users (
    id INT UNSIGNED NOT NULL auto_increment PRIMARY KEY,
    name char(50) not null ,
    password char(100) not null
);

INSERT INTO authorized_users VALUES( 1, 'testuser', sha1('password') );
