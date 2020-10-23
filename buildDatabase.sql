CREATE TABLE profile_image(
	image_id int(11) not null PRIMARY KEY AUTO_INCREMENT,
    userid int(11) not null,
    status int(11) not null,
    FOREIGN KEY profile_image(userid) REFERENCES users(id)
);

INSERT INTO profile_image(userid,status) VALUES 
(1,0);


CREATE TABLE users(
	id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    pw VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL UNIQUE,
    bdate DATE NOT NULL
);





INSERT INTO users(username,pw,email,bdate) VALUES ('bcifliku','admin','bcifliku17@epoka.edu.al','1999-09-06');

CREATE TABLE status(
	status_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    user_status VARCHAR(255) NOT NULL,
    FOREIGN KEY status(user_id) REFERENCES users(id)
);

INSERT INTO status(user_id,user_status) VALUES 
(1,'user');

CREATE TABLE store(
	product_id INT PRIMARY KEY AUTO_INCREMENT,
    product_name VARCHAR(255) NOT NULL,
    product_descr TEXT NOT NULL,
    product_price_was DOUBLE NOT NULL,
    product_price_is DOUBLE NOT NULL,
    quantity INT NOT NULL
);
INSERT INTO store(product_name,product_descr,product_price_was,product_price_is,quantity) VALUES
('Playstation 4','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',299.99,199.99,20),
('X Box One','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',399.99,279.99,10),
('Gaming PC','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',299.99,199.99,5);

INSERT INTO store(product_name,product_descr,product_price_was,product_price_is,quantity) VALUES
('Playstation 5','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',1299.99,999.99,3);

CREATE TABLE course(
    cid INT PRIMARY KEY AUTO_INCREMENT,
    ctitle VARCHAR(200) NOT NULL,
    cprice DOUBLE NOT NULL,
    cimage VARCHAR(200) NOT NULL,
    cvideo VARCHAR(200) NOT NULL,
    cdescription VARCHAR(400) NOT NULL
);

CREATE TABLE user_course(
    ucid INT(11) PRIMARY KEY AUTO_INCREMENT,
    userid INT(11) NOT NULL,
    courseid INT(11) NOT NULL,
    FOREIGN KEY (userid) REFERENCES users(id),
    FOREIGN KEY (courseid) REFERENCES course(cid)
);


CREATE TABLE messages(
	id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(225) NOT NULL,
    email VARCHAR(225) NOT NULL,
    msg TEXT,
    status INT
);