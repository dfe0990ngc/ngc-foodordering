set transaction read write;
CREATE TABLE categories (
  ID SERIAL PRIMARY KEY,
  name varchar(32) DEFAULT NULL,
  description varchar(255) DEFAULT NULL,
  parent Integer DEFAULT 0,
  active integer DEFAULT 1
) ;

INSERT INTO categories (ID, name, description, parent, active) VALUES
(1, 'Burgers', 'Burger with cheese', 0, 1),
(5, 'Beverages', 'Test only', 0, 1),
(7, 'Combo Meals', 'Combo Meals', 0, 1);

CREATE TABLE coupon (
  ID SERIAL PRIMARY KEY,
  code varchar(16) DEFAULT NULL,
  discount double PRECISION,
  datestart timestamp DEFAULT current_timestamp,
  dateend timestamp DEFAULT current_timestamp,
  lastupdateby Integer DEFAULT 0,
  dateupdated timestamp DEFAULT current_timestamp
) ;

CREATE TABLE customers (
  ID SERIAL PRIMARY KEY,
  fname varchar(32) DEFAULT NULL,
  lname varchar(32) DEFAULT NULL,
  mname varchar(32) DEFAULT NULL,
  contactno varchar(15) DEFAULT NULL,
  email varchar(45) DEFAULT NULL,
  datejoined timestamp DEFAULT current_timestamp,
  provice varchar(20) DEFAULT NULL,
  city varchar(20) DEFAULT NULL,
  barangay varchar(20) DEFAULT NULL,
  sitio varchar(20) DEFAULT NULL,
  purok varchar(20) DEFAULT NULL,
  zipcode varchar(10) DEFAULT NULL,
  password varchar(64) DEFAULT NULL
) ;

CREATE TABLE employees (
  ID SERIAL PRIMARY KEY,
  fname varchar(32) DEFAULT NULL,
  lname varchar(32) DEFAULT NULL,
  mname varchar(32) DEFAULT NULL,
  nname varchar(32) DEFAULT NULL,
  datejoined date DEFAULT NULL,
  username varchar(32) DEFAULT NULL,
  password varchar(64) DEFAULT NULL
) ;

INSERT INTO employees (ID, fname, lname, mname, nname, datejoined, username, password) VALUES
(1, 'Nelson', 'Cañete', 'Gabriel', 'nels', '2021-09-24', 'admin', 'admin'),
(2, 'Redin', 'Cañete', 'Gabriel', 'din', '2021-09-27', 'RedIn', 'RedIn'),
(3, 'John Pol', 'Cañete', 'Gabriel', 'poy', '2021-09-25', 'JohnPol', 'JohnPol'),
(8, 'Rosemarie', 'Cañete', 'Gabriel', 'kalot', '2021-09-27', 'Rose', 'Rose');


CREATE TABLE orderdetails (
  ID SERIAL PRIMARY KEY,
  ordermasterid Integer DEFAULT 0,
  productid Integer DEFAULT 0,
  price double PRECISION,
  dateadded timestamp DEFAULT current_timestamp
) ;

CREATE TABLE orders (
  ID SERIAL PRIMARY KEY,
  customerid Integer DEFAULT 0,
  total double PRECISION,
  datetodelivered timestamp DEFAULT current_timestamp,
  paymentterm varchar(32) DEFAULT NULL,
  orderstatus integer DEFAULT 1,
  datecompleted timestamp DEFAULT current_timestamp,
  completedby Integer DEFAULT 0,
  remarks varchar(512) DEFAULT NULL
) ;

--orderstatus enum('processing','completed','cancelled','returned') DEFAULT 'processing',


CREATE TABLE products (
  ID SERIAL PRIMARY KEY,
  name varchar(64) DEFAULT NULL,
  description varchar(255) DEFAULT NULL,
  photo varchar(255) DEFAULT NULL,
  price double PRECISION,
  tax double PRECISION,
  dateupdated timestamp DEFAULT current_timestamp,
  active integer DEFAULT 1
) ;


CREATE TABLE products_category (
  productid Integer DEFAULT 0,
  categoryid Integer DEFAULT 0
) ;


CREATE TABLE users (
  ID SERIAL PRIMARY KEY,
  username varchar(32) DEFAULT NULL,
  password varchar(64) DEFAULT NULL,
  employeeid Integer DEFAULT 0
) ;
COMMIT;