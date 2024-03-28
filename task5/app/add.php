<?php

if (isset($_POST['title'])) { // Check if the 'title' parameter is set in the POST request

  require '../db_conn.php'; // Require the 'db_conn.php' file to establish a database connection

  $title = $_POST['title']; // Retrieve the value of the 'title' parameter from the POST request

  if (empty($title)) { // Check if the 'title' parameter is empty

    header("Location: ../index.php?mess=error"); // Redirect to the index page with a 'mess' parameter indicating error
  } else { // If 'title' is not empty

    $stmt = $conn->prepare("INSERT INTO todos(title) VALUE(?)"); // Prepare an INSERT statement to insert the 'title' value into the 'todos' table

    $res = $stmt->execute([$title]); // Execute the prepared statement with the provided 'title' value

    if ($res) { // If the query execution is successful

      header("Location: ../index.php?mess=success"); // Redirect to the index page with a 'mess' parameter indicating success

    } else { // If the query execution fails

      header("Location: ../index.php"); // Redirect to the index page without indicating any specific message

    }
    $conn = null; // Close the database connection
    exit(); // Terminate the script execution
  }
} else { // If the 'title' parameter is not set in the POST request

  header("Location: ../index.php?mess=error"); // Redirect to the index page with a 'mess' parameter indicating error
}
