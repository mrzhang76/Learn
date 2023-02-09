create database books;
grant all on *.* to 'fred' identified by 'mnb123' with grant option;
revoke all privileges , grant option from 'fred';
grant usage on books.* to 'sally'@'localhost' identified by 'magic123';
grant select,insert,update,delete,index,alter,create,drop on books.* to 'sally'@'localhost';
revoke alter,create,drop on books.* from 'sally'@'localhost';
revoke all on books.* from 'sally'@'localhost';
grant select,insert,delete,update on books.* to 'bookorama' identified by 'bookorama123';
grant select,insert,update,delete,index,create,drop on books.* to 'bookorama' identified by 'bookorama123'; 
 
 /*Mysql-8授权语句发生变化*/
create user 'bookorama'@'localhost' identified by 'bookorama123';
grant select,insert,delete,update on books.* to 'bookorama'@'localhost'  ;
grant select,insert,update,delete,index,create,drop on books.* to 'bookorama'@'localhost' ; 

show tables;
show databases;
describe books;
insert into customers values (null,'Julie Smith','25 Oak Street','Airport West');
insert into customers (name,city) values ('Melissa Jones','Nar Nar Goon North');
/*ERROR 1364 (HY000): Field 'address' doesn't have a default value*/
insert into customers set name = 'Michael Archer',Address = '12 Adderley Avenue' ,City = 'Leeton';

select name,city from customers;
select * from order_items;
select * from orders where customerID = 3;
select * from orders where customerID = 3 or customerID = 4;

select Orders.orderID ,Orders.Amount,Orders.Date from Customers,Orders 
where customers.name = 'Julie Smith' and customers.customerID = Orders.CustomerID;

select customers.name from Customers,Orders,Order_items,books 
where customers.customerID = Orders.customerID
and orders.orderID = order_items.orderID
and order_items.ISBN = books.ISBN
and books.title like '%Java%';

select customers.CustomerID,customers.Name,Orders.orderID 
from customers left join orders
on customers.customerID = orders.customerID;

select customers.customerid,customers.name from customers left join orders using (customerID) where orders.orderID is null;
insert into customers values (null,'George Napolitano','177 Melbor Road','Coburg');
select C.name from customers as C,orders as O, order_items as OI,Books as Books
where C.customerID = O.customerID
and O.orderID = OI.orderID
and OI.isbn = B.isbn
and B.title like '%Java%';

select C1.name,C2.name,C1.city
from customers as C1, customers as C2
where C1.city = C2.city
and C1.name != C2.name;

select name,address from customers order by name;
select name,address from customers order by name asc;
select name,address from customers order by name desc;

select avg(amount) from orders;
select customerID,avg(amount) from orders group by customerID;
select customerID,avg(amount) from orders group by customerID having avg(amount) > 50;

select name from customers limit 2;
select name from customers limit 2,3;

select customerID,amount from orders where amount = (select max(amount) from orders);
select customerID,amount from orders order by amount desc limit 1;

select isbn,title from Books where not exists (select * from order_items where order_items.isbn = books.isbn);

select * from (select customerID,name from Customers where city = 'Box Hill') as box_hill_customers;

update books set price = price * 1.1;
update customers set address = '250 Olsens Road' where customerID = 4;

alter table customers modify name char(70) not null;
alter table orders add tax float(6,2) after amount;

alter table orders drop tax;

delete from customers where customerID=5;