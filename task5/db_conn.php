<?php

// Craete a MySql Database in PHPMyAdmin of the XAMPP server named as "to_do_list"

/*under the database "to_do_list" create a table named "todos" with the following command:
CREATE TABLE `todos` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `checked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1; */

//Make sure that the XAMPP server credentials are as follows:

$sName = "localhost"; // Define the server name where the database is hosted

$uName = "root"; // Define the username used to connect to the database

$pass = ""; // Define the password used to connect to the database

$db_name = "to_do_list"; // Define the name of the database to connect to

try { // Start a try-catch block to handle potential exceptions

  // Attempt to create a new PDO object to establish a connection to the MySQL database
  // The connection string includes the server name, database name, username, and password
  $conn = new PDO(
    "mysql:host=$sName;dbname=$db_name",
    $uName,
    $pass
  );

  // Set the error mode of the PDO object to throw exceptions
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) { // Catch any PDOExceptions that occur during the connection attempt

  // Output an error message indicating that the connection failed, along with the error message from the exception
  echo "Connection failed : " . $e->getMessage();

}