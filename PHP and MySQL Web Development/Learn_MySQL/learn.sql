create database Books;
/*
适用于Mysql-5.x的授权语句

grant all on *.* to 'fred' identified by 'mnb123' with grant option;
revoke all privileges , grant option from 'fred';

grant usage on Books.* to 'sally'@'localhost' identified by 'magic123';
grant select,insert,update,delete,index,alter,create,drop on Books.* to 'sally'@'localhost';
revoke alter,create,drop on Books.* from 'sally'@'localhost';
revoke all on Books.* from 'sally'@'localhost';


grant select,insert,delete,update on Books.* to 'bookorama' identified by 'bookorama123';
grant select,insert,update,delete,index,create,drop on Books.* to 'bookorama' identified by 'bookorama123'; 
*/

/*Mysql-8授权语句发生变化*/

create user 'fred'@'localhost' identified by 'mnb123';
grant all on *.* to 'fred'@'localhost';
revoke all privileges on *.* from 'fred'@'localhost';

create user 'sally'@'localhost' identified by 'magic123';
grant select,insert,delete,update on Books.* to 'sally'@'localhost' ;
revoke alter,create,drop on Books.* from 'sally'@'localhost';
revoke all on Books.* from 'sally'@'localhost';
show grants for 'sally'@'localhost';
flush privileges;

create user 'bookorama'@'localhost' identified by 'bookorama123';
grant select,insert,delete,update on books.* to 'bookorama'@'localhost';
grant select,insert,update,delete,index,create,drop on books.* to 'bookorama'@'localhost'; 

show tables;
show databases;
describe Books;

insert into Customers values (null,'Julie Smith','25 Oak Street','Airport West');
insert into Customers (Name,City) values ('Melissa Jones','Nar Nar Goon North');
/*ERROR 1364 (HY000): Field 'address' doesn't have a default value*/
insert into Customers set Name = 'Michael Archer',Address = '12 Adderley Avenue' ,City = 'Leeton';

select Name,City from Customers;
select * from Order_items;
select * from Orders where CustomerID = 3;
select * from Orders where CustomerID = 3 or CustomerID = 4;

select Orders.OrderID ,Orders.Amount,Orders.Date from Customers,Orders 
where Customers.Name = 'Julie Smith' and Customers.CustomerID = Orders.CustomerID;

select Customers.Name from Customers,Orders,Order_items,Books 
where Customers.CustomerID = Orders.CustomerID
and Orders.OrderID = Order_items.OrderID
and Order_items.ISBN = Books.ISBN
and Books.Title like '%Java%';

select Customers.CustomerID,Customers.Name,Orders.OrderID 
from Customers left join Orders
on Customers.CustomerID = Orders.CustomerID;

select Customers.CustomerId,Customers.Name from Customers left join Orders using (CustomerID) where Orders.OrderID is null;
insert into Customers values (null,'George Napolitano','177 Melbor Road','Coburg');
select C.name from Customers as C,Orders as O, Order_items as OI,Books as B
where C.CustomerID = O.CustomerID
and O.OrderID = OI.OrderID
and OI.ISBN = B.ISBN
and B.Title like '%Java%';

select C1.Name,C2.Name,C1.City
from Customers as C1, Customers as C2
where C1.City = C2.City
and C1.Name != C2.Name;

select Name,Address from Customers order by Name;
select Name,Address from Customers order by Name asc;
select Name,Address from Customers order by Name desc;

select avg(Amount) from Orders;
select CustomerID,avg(Amount) from Orders group by CustomerID;
select CustomerID,avg(Amount) from Orders group by CustomerID having avg(Amount) > 50;

select Name from Customers limit 2;
select Name from Customers limit 2,3;

select CustomerID,Amount from Orders where Amount = (select max(Amount) from Orders);
select CustomerID,Amount from Orders order by Amount desc limit 1;

select ISBN,Title from Books where not exists (select * from Order_items where Order_items.ISBN = Books.ISBN);

select * from (select CustomerID,Name from Customers where City = 'Box Hill') as Box_hill_customers;

update Books set Price = Price * 1.1;
update Customers set Address = '250 Olsens Road' where CustomerID = 4;

alter table Customers modify Name char(70) not null;
alter table Orders add Tax float(6,2) after Amount;

alter table Orders drop Tax;

delete from Customers where CustomerID=5;