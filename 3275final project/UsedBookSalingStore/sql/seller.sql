-- phpMyAdmin SQL Dump -- version 4.5.4.1deb2ubuntu2 -- http://www.phpmyadmin.net -- -- Host: localhost -- Generation Time: Sep 14 2020 at 04:39 PM -- Server version: 5.7.16-0ubuntu0.16.04.1 -- PHP Version: 7.0.8-0ubuntu0.16.04.3 -- -- Database: `clinic` -- -- -------------------------------------------------------- -- -- TABLE structure for TABLE `doctor` 
DROP TABLE IF EXISTS seller;
CREATE TABLE seller(
    sellerId int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    sellerName varchar(50) NOT NULL,
    contactNo varchar(15) NOT NULL,
    password varchar(100),
    email varchar(100) NOT NULL,
    address varchar(100) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;




--
-- Dumping data for table `seller`
--
insert into
    seller (
        sellerName,
        address,
        contactNo,
        email)values
    (
        'AshwinAshok',
        '8th street',
        '779-544-4457',
        'ashwin@gmail.com'
    ),

    (
        'Jill',
        'New Westminster',
        '789-996-3864',
        'jadanez1@aboutads.info'
    );




