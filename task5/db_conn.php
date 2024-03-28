<?php

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