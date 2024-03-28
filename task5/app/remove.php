<?php

if (isset($_POST['id'])) {  // Check if the 'id' parameter is set in the POST request

  require '../db_conn.php';  // Require the 'db_conn.php' file to establish a database connection

  $id = $_POST['id'];  // Retrieve the value of the 'id' parameter from the POST request

  if (empty($id)) {  // Check if the 'id' parameter is empty

    echo 0;  // Output '0' to indicate that the 'id' parameter is empty

  } else {  // If 'id' is not empty
    // Prepare a DELETE statement to delete the todo item with the provided 'id' from the 'todos' table
    $stmt = $conn->prepare("DELETE FROM todos WHERE id=?");
    // Execute the prepared statement with the provided 'id'
    $res = $stmt->execute([$id]);
    if ($res) {  // If the query execution is successful

      echo 1; // Output '1' to indicate that the todo item was successfully deleted

    } else { // If the query execution fails

      echo 0; // Output '0' to indicate that the todo item deletion failed

    }
    $conn = null;  // Close the database connection
    exit();  // Terminate the script execution
  }
} else {  // If the 'id' parameter is not set in the POST request

  header("Location: ../index.php?mess=error");  // Redirect to the index page with a 'mess' parameter indicating error
}