<?php

$path = $_SERVER['DOCUMENT_ROOT'];
require_once $path."/healthy/databaseConnection.php";

// Create Table
$sql = "CREATE table user_authentication(
    user_id int auto_increment primary key,
    user_name varchar(100) ,
    email_id varchar(100)unique,
    password varchar(255),
    user_type varchar(20)
)";

if (mysqli_query($conn, $sql) === TRUE) {
    echo "Table 'user_authentication' created successfully";
} else {
    echo "Error creating table";
}

$sql = "CREATE table products_and_services(
    product_id int auto_increment primary key,
    product_name varchar(100) ,
    product_description text,
    product_or_service varchar(25),
    quantity int,
    health_benefits text, 
    price_category varchar(25),
    certifications varchar(25),
    product_status varchar(25),
    votes_yes_no varchar(25),
    product_category varchar(25) unique
)";

if (mysqli_query($conn, $sql) === TRUE) {
    echo "Table 'products_and_services' created successfully";
} else {
    echo "Error creating table";
}
//councilor table
//CREATE TABLE councilor ( id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100) NOT NULL, contact_number CHAR(10) NOT NULL, county_id INT, FOREIGN KEY (county_id) REFERENCES county(id) );
//county table
// CREATE TABLE county (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     region VARCHAR(100),
//     county VARCHAR(100)
// );

// Close Connection