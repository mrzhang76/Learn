/* 创建Book-O-Rama数据库表*/ 
CREATE DATABASE Books;
USE Books;

CREATE TABLE Customers (
CustomerID INT UNSIGNED NOT NULL auto_increment PRIMARY KEY,
    NAME CHAR ( 50 ) NOT NULL,
    Address CHAR ( 100 ) NOT NULL,
    City CHAR ( 30 ) NOT NULL 
);

CREATE TABLE Orders (
    OrderID INT UNSIGNED NOT NULL auto_increment PRIMARY KEY,
    CustomerID INT UNSIGNED NOT NULL,
    Amount FLOAT ( 6, 2 ),
    Date date NOT NULL,
    FOREIGN KEY ( CustomerID ) REFERENCES Customers ( CustomerID ) 
);

CREATE TABLE Books (
    ISBN CHAR ( 13 ) NOT NULL PRIMARY KEY,
    Author CHAR ( 50 ),
    Title CHAR ( 100 ),
    Price FLOAT ( 4, 2 ) 
);

CREATE TABLE Order_items (
    OrderId INT UNSIGNED NOT NULL,
    ISBN CHAR ( 13 ) NOT NULL,
    Quantity TINYINT UNSIGNED,
    PRIMARY KEY ( OrderId, ISBN ),
    FOREIGN KEY ( OrderId ) REFERENCES Orders ( OrderId ),
    FOREIGN KEY ( ISBN ) REFERENCES Books ( ISBN ) 
);

CREATE TABLE Book_reviews ( 
    ISBN CHAR ( 13 ) NOT NULL PRIMARY KEY, 
    Review text, FOREIGN KEY ( ISBN ) REFERENCES Books ( ISBN ) 
);