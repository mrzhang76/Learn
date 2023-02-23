CREATE BATABASE chat;
USE chat;
CREATE TABLE chatlog (
    id INT(11) AUTO_INCREMENT PRIMARY KEY;
    message TEXT;
    sent_by VARCHAR(50);
    data_created INT(11);
);

create user 'webchat'@'localhost' identified by 'webchat';
grant select,insert,update,delete,index,create,drop on chat.* to 'webchat'@'localhost';