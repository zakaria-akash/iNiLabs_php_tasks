<?php
// Define a logging interface
interface Logger
{
  public function log($message);
}

// Implement a FileLogger class that logs messages to a file
class FileLogger implements Logger
{
  private $logFile;

  // Constructor to initialize the log file
  public function __construct($logFile)
  {
    $this->logFile = $logFile;
  }

  // Method to log a message to the file
  public function log($message)
  {
    // Open the log file in append mode
    $file = fopen($this->logFile, 'a');
    if ($file) {
      // Write the message to the file
      fwrite($file, date('Y-m-d H:i:s') . ' - ' . $message . "\n");
      // Close the file
      fclose($file);
    } else {
      echo "Error: Unable to open log file for writing.";
    }
  }
}

// Implement a DatabaseLogger class that logs messages to a database
class DatabaseLogger implements Logger
{
  private $pdo;

  // Constructor to initialize the PDO object for database connection
  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  // Method to log a message to the database
  public function log($message)
  {
    // Prepare a SQL statement to insert the log message into the database
    $statement = $this->pdo->prepare("INSERT INTO logs (timestamp, message) VALUES (:timestamp, :message)");
    // Bind the parameters
    $statement->bindParam(':timestamp', date('Y-m-d H:i:s'));
    $statement->bindParam(':message', $message);
    // Execute the SQL statement
    $result = $statement->execute();
    if (!$result) {
      echo "Error: Failed to log message to the database.";
    }
  }
}

// Example usage of the logging system
$fileLogger = new FileLogger('logfile.txt');
$fileLogger->log("This is a message logged to a file.");

// Assume $pdo is a PDO object for database connection
$databaseLogger = new DatabaseLogger($pdo);
$databaseLogger->log("This is a message logged to a database.");