create table customers(
    customerID int unsigned not null auto_increment primary key,
    name char(50) not null,
    address char(100) not null,
    city char(30) not null
);

create table orders(
    orderID int unsigned not null auto_increment primary key,
    customerID int unsigned not null,
    amount float(6,2),
    date date not null,
    foreign key (CustomerID) peferences customers(CustomerID)
);

create table Books(
    ISBN char(13) not null primary key,
    author char(50),
    title char(100),
    price float(4,2)
);

create table order_items(
    orderid int unsigned not null,
    isbn char(13) not null,
    Quantity tinyint unsigned,

    primary key (orderid,isbn),
    foreign key (orderid) peferences orders(orderid),
    foreign key (isbn) peferences books(isbn)
);

create table book_reviews(
    isbn char(13) not null primary key,
    review text,

    foreign key (ISBN) peferences books(isbn)
)