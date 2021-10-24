<?php
echo "Welcome to the stage where we are ready toget connected to a database";

$servername = "localhost";
$username = "root";
$password = "";
$database = "luckybhardwaj";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Sorry we failed to connect: " . mysqli_connect_error());
} else {
    echo "Connection was successful";
}

// create database

// $sql = "CREATE DATABASE dbHarry2";

// $result = mysqli_query($conn, $sql);


// check for the database creation success

// if($result) {
//     echo "The db was created successully";
// } else {
//     echo "not created successfully" . mysqli_error($conn);
// }
// $sql = "CREATE TABLE `nvideos` (`sno` INT(6) NOT NULL AUTO_INCREMENT, `name` VARCHAR(12) NOT NULL, `dest` VARCHAR(6) NOT NULL, PRIMARY KEY (`sno`))";

$sql = "INSERT INTO `videos` (`name`, `description`, `path`, `likes`, `date`) VALUES ('third video', 'this is third video', './third.mp4', '5', current_timestamp())";

$result = mysqli_query($conn, $sql);

if($result) {
    echo "The table was created successully";
} else {
    echo "table not created successfully" . mysqli_error($conn);
}
?>