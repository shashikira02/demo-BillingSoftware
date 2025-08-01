use billsoftware;
CREATE TABLE product(
    user_id INT,
    product_code VARCHAR(6),
    product_name VARCHAR(20),
    product_price INT,
    intial_qty INT DEFAULT 0,
    available_qty INT,
    PRIMARY KEY(user_id, product_code)
);
# bill id IS calculated BY finding the highest VALUE OF the COLUMN 'bill_id' IN the 'bill' TABLE
CREATE TABLE bill_item(
    user_id INT,
    bill_id INT,
    product_code VARCHAR(10),
    product_qty INT,
    product_price INT,
    date DATE NOT NULL,
    PRIMARY KEY(user_id, bill_id, product_code)
);
CREATE TABLE bill(
    user_id INT,
    bill_id INT,
    customer_name VARCHAR(30),
    customer_phone VARCHAR(10),
    customer_mail VARCHAR(30),
    payment_mode VARCHAR(10),
    pdf LONGBLOB,
    PRIMARY KEY(user_id, bill_id)
);
 
CREATE TABLE storeowner(
    user_id INT AUTO_INCREMENT,
    user_pwd VARCHAR(100),
    user_mail VARCHAR(30),
    user_phone VARCHAR(10),
    store_name VARCHAR(30),
    gst_no VARCHAR(30),
    PRIMARY KEY(user_id)
);
 
CREATE TABLE admin(
    admin_id INT AUTO_INCREMENT,
    admin_mail VARCHAR(30),
    admin_pwd VARCHAR(30),
    admin_name VARCHAR(30),
    
    PRIMARY KEY(admin_id)
);
 
 
CREATE TABLE customer(
    customer_name VARCHAR(30),
    customer_phone INT,
    custoemr_mail VARCHAR(30),
    PRIMARY KEY(customer_phone)
);
 
CREATE TABLE complain(
 
    complain_id INT AUTO_INCREMENT,
    complain_title VARCHAR(30),
    user_id INT,
    admin_id INT,
    complain_status VARCHAR(10), 
    PRIMARY KEY(complain_id)
);
 
 
CREATE TABLE chat(
 
    complain_id INT,
    chat_id INT,
    chat_msg VARCHAR(100),
    PRIMARY KEY(complain_id, chat_id)
);
