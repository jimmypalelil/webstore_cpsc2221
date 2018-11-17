
/*SQL Statements*/

CREATE table USERS (
    UID INTEGER PRIMARY KEY auto_increment,
    email CHAR(40) UNIQUE,
    password CHAR(20),
    firstName CHAR(20),
    lastName CHAR(20),
    address CHAR(20),
    role INTEGER DEFAULT 2   
);

CREATE table ORDERS(
    orderNo INTEGER PRIMARY KEY auto_increment,
    orderDate DATE,
    totalPrice REAL,
    UID INTEGER ,
    FOREIGN KEY (UID) REFERENCES USERS(UID) ON DELETE CASCADE
);

CREATE TABLE PRODUCT (
PID INTEGER PRIMARY KEY auto_increment,
name CHAR(20),
brand CHAR(20),
colour CHAR(20),
price REAL(6,2),
storage CHAR(10),
year INTEGER,
type CHAR(20),
lens CHAR(20) DEFAULT NULL,
cpu CHAR(20) DEFAULT NULL,
screen_size CHAR(20) DEFAULT NULL,
ram CHAR(20) DEFAULT NULL,
camera CHAR(20) DEFAULT NULL,
network CHAR(20) DEFAULT NULL
);

CREATE table ORDERITEMS (
    orderNo INTEGER,
    PID INTEGER,
    PRIMARY KEY(orderNo, PID),
    quantity INTEGER,
    totalPrice REAL,    
    FOREIGN KEY (PID) REFERENCES PRODUCT(PID) ON DELETE CASCADE,
    FOREIGN KEY (orderNo) REFERENCES ORDERS(orderNo) ON DELETE CASCADE

);

CREATE TABLE Shopping_cart (
    UID INTEGER,
    PID INTEGER,
    PRIMARY KEY(UID, PID),
    quantity INTEGER,
    totalPrice REAL,
    FOREIGN KEY (UID) REFERENCES USERS(UID) ON DELETE CASCADE,
    FOREIGN KEY (PID) REFERENCES PRODUCT(PID) ON DELETE CASCADE
);

/* Altering tables for auto increments */
ALTER TABLE USERS AUTO_INCREMENT=1;
ALTER TABLE PRODUCT AUTO_INCREMENT = 1;
ALTER TABLE ORDERS AUTO_INCREMENT = 1;


/*INSERT STATEMENTS*/

/*PRODUCTS*/

/*Camera*/
INSERT INTO PRODUCT(name, brand, colour, price, storage, year, type, lens)
VALUES('PowerShot', 'Canon', 'Black', '549.00', '16GB', '2018', 'camera', 'Ultra wide angle');

INSERT INTO PRODUCT(name, brand, colour, price, storage, year, type, lens)
VALUES('Rebel T6', 'Canon', 'Black', '389.00', '32GB', '2018', 'camera', 'Wide angle');

INSERT INTO PRODUCT(name, brand, colour, price, storage, year, type, lens)
VALUES('Printomatic', 'Kodak', 'Grey', '159.00', '8GB', '2018', 'camera', 'Standard');

INSERT INTO PRODUCT(name, brand, colour, price, storage, year, type, lens)
VALUES('Instax Mini', 'FujiFilm', 'Rose Gold', '269.00', '16GB', '2018', 'camera', 'Standard');

INSERT INTO PRODUCT(name, brand, colour, price, storage, year, type, lens)
VALUES('D5300', 'Canon', 'Black', '789.00', '32GB', '2017', 'camera', 'Standard Telephoto');


/*Laptop*/
INSERT INTO PRODUCT(name, brand, colour, price, storage, year, type, screen_size, ram, cpu)
VALUES('Macbook Pro', 'Apple', 'Silver', '1499.00', '1TB', '2018', 'laptop', '15 inches', '8GB DDR4', 'Intel i7');

INSERT INTO PRODUCT(name, brand, colour, price, storage, year, type, screen_size, ram, cpu)
VALUES('Macbook Air', 'Apple', 'Rose Gold', '2599.00', '1TB', '2018', 'laptop', '13 inches', '8GB DDR4', 'Intel i7');

INSERT INTO PRODUCT(name, brand, colour, price, storage, year, type, screen_size, ram, cpu)
VALUES('HP Envy', 'HP', 'Navy Blue', '1399.00', '1TB', '2017', 'laptop', '15 inches', '8GB DDR4', 'Intel i5');

INSERT INTO PRODUCT(name, brand, colour, price, storage, year, type, screen_size, ram, cpu)
VALUES('Dell XPS', 'Dell', 'Grey', '1600.00', '1TB', '2017', 'laptop', '13 inches', '8GB DDR4', 'Intel i3');

INSERT INTO PRODUCT(name, brand, colour, price, storage, year, type, screen_size, ram, cpu)
VALUES('Alienware', 'Dell', 'Black', '2999.00', '2TB', '2018', 'laptop', '18 inches', '32GB DDR4', 'Intel i7');

/*Cellphone*/
INSERT INTO PRODUCT(name, brand, colour, price, storage, year, type, screen_size, ram, cpu, network, camera)
VALUES ('Galaxy S7', 'Samsung', 'Black', '599.00', '32GB', '2017', 'cellphone', '5.5 inches', '4GB', 'Snapdragon 810', 'Rogers', '12 Megapixel');

INSERT INTO PRODUCT(name, brand, colour, price, storage, year, type, screen_size, ram, cpu, network, camera)
VALUES('Galaxy S8', 'Samsung', 'Grey', '899.00', '32GB', '2017', 'cellphone', '5.5 inches', '6GB', 'Snapdragon 830', 'Fido', '12 Megapixel');

INSERT INTO PRODUCT(name, brand, colour, price, storage, year, type, screen_size, ram, cpu, network, camera)
VALUES('Galaxy S9', 'Samsung', 'Black', '999.00', '32GB', '2018', 'cellphone', '5.5 inches', '8GB', 'Snapdragon 845', 'Bell', '12 Megapixel');

INSERT INTO PRODUCT(name, brand, colour, price, storage, year, type, screen_size, ram, cpu, network, camera)
VALUES('IPhone X', 'Apple', 'Rose Gold', '1199.00', '64GB', '2017', 'cellphone', '6.0 inches', '4GB', 'A10', 'Telus', '12 Megapixel');

INSERT INTO PRODUCT(name, brand, colour, price, storage, year, type, screen_size, ram, cpu, network, camera)
VALUES('OnePlus 6T', 'OnePlus', 'Black', '749.00', '64GB', '2017', 'cellphone', '6.0 inches', '8GB', 'Snapdragon 845', 'Koodo', '12 Megapixel');


/*Tablet*/
INSERT INTO PRODUCT(name, brand, colour, price, storage, year, type, screen_size, ram, cpu, camera)
VALUES('IPad', 'Apple', 'Black', '799.00', '64GB', '2017', 'tablet', '10 inches', '8GB', 'A12', '2 Megapixels');

INSERT INTO PRODUCT(name, brand, colour, price, storage, year, type, screen_size, ram, cpu, camera)
VALUES('IPad Pro', 'Apple', 'White', '899.00', '64GB', '2018', 'tablet', '10 inches', '8GB', 'A12X', '12 Megapixels');

INSERT INTO PRODUCT(name, brand, colour, price, storage, year, type, screen_size, ram, cpu, camera)
VALUES('Galaxy Tab E', 'Samsung', 'Black', '249.00', '32GB', '2018', 'tablet', '9.6 inches', '2GB', 'Samsung Exynos', '2 Megapixels');

INSERT INTO PRODUCT(name, brand, colour, price, storage, year, type, screen_size, ram, cpu, camera)
VALUES('Galaxy Tab Pro', 'Samsung', 'White', '799.00', '64GB', '2018', 'tablet', '10 inches', '4GB', 'Samsung Exynos', '12 Megapixels');

INSERT INTO PRODUCT(name, brand, colour, price, storage, year, type, screen_size, ram, cpu, camera)
VALUES('Galaxy Tab J', 'Samsung', 'Grey', '449.00', '64GB', '2018', 'tablet', '9.5 inches', '2GB', 'Samsung Exynos', '12 Megapixels');



/*Smartwatch*/
INSERT INTO PRODUCT(name, brand, colour, price, storage, year, type, screen_size, cpu)
VALUES('Gear S3', 'Samsung', 'Brown', '399.00', '1.5GB', '2017', 'smartwatch', '1.3 inches', 'Samsung Exynos');

INSERT INTO PRODUCT(name, brand, colour, price, storage, year, type, screen_size, cpu)
VALUES('Moto 360 2', 'Motorola', 'Grey', '559.00', '2GB', '2018', 'smartwatch', '1.3 inches', 'Snapdragon 150');

INSERT INTO PRODUCT(name, brand, colour, price, storage, year, type, screen_size, cpu)
VALUES('Apple Watch', 'Apple', 'Black', '499.00', '2GB', '2018', 'smartwatch', '1.3 inches', 'A1.12');

/*USERS*/
INSERT INTO USERS ( email, password, firstName, lastName, address, role)
VALUES ( 'jimmy@webstore.com', 'adminpass', 'Jimmy', 'Palelil', '1354 Main street', 0);

INSERT INTO USERS ( email, password, firstName, lastName, address, role)
VALUES ( 'shawn@webstore.com', '1234password', 'Shawn', 'Ritchie', '1365 98a avenue', 1);

INSERT INTO USERS ( email, password, firstName, lastName, address, role)
VALUES ( 'ashley@webstore.com', 'pass', 'Ashley', 'Wong', '2332 10th avenue', 2);

INSERT INTO USERS ( email, password, firstName, lastName, address, role)
VALUES ( 'chalvin@webstore.com', 'pass', 'Chalvin', 'S', '2332 10th avenue', 2);

