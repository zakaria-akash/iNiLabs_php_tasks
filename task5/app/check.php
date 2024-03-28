<?php
// Check if the 'id' parameter is set in the POST request
if (isset($_POST['id'])) {
  // Require the 'db_conn.php' file to establish a database connection
  require '../db_conn.php';
  // Retrieve the value of the 'id' parameter from the POST request
  $id = $_POST['id'];
  // Check if the 'id' parameter is empty
  if (empty($id)) {
    // If 'id' is empty, output 'error'
    echo 'error';

  } else { // If 'id' is not empty
    // Prepare a SELECT query to retrieve the 'id' and 'checked' columns from the 'todos' table based on the provided 'id'
    $todos = $conn->prepare("SELECT id, checked FROM todos WHERE id=?");
    // Execute the prepared statement with the provided 'id'
    $todos->execute([$id]);
    // Fetch the result of the executed query
    $todo = $todos->fetch();
    // Retrieve the 'id' value of the fetched todo
    $uId = $todo['id'];
    // Retrieve the 'checked' value of the fetched todo
    $checked = $todo['checked'];
    // Toggle the value of 'checked' (if it's true, set it to false, otherwise set it to true)
    $uChecked = $checked ? 0 : 1;
    // Execute an UPDATE query to toggle the 'checked' status of the todo item with the provided 'id'
    $res = $conn->query("UPDATE todos SET checked=$uChecked WHERE id=$uId");
    // If the query execution is successful
    if ($res) {
      // Output the previous 'checked' status of the todo item
      echo $checked;

    } else { // If the query execution fails
      // Output 'error'
      echo "error";

    }
    // Close the database connection
    $conn = null;
    // Terminate the script execution
    exit();
  }
} else { // If the 'id' parameter is not set in the POST request
  // Redirect to the index page with a 'mess' parameter indicating error
  header("Location: ../index.php?mess=error");
}
