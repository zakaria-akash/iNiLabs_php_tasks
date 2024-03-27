<?php
// Define the database connection parameters
$host = 'localhost'; // Assuming MySQL is running on the same server
$dbname = 'test'; // The name of the database
$username = 'root'; // Your MySQL username
$password = ''; // Your MySQL password

//create a table named "logs" in the mysql db named "test" with following sql command:
/*CREATE TABLE logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  message TEXT
);*/

try {
  // Establish a PDO connection to the MySQL database
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  // Set PDO to throw exceptions on errors
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Define an interface for logging
  interface Logger
  {
    // Method to log a message
    public function log($message);
  }

  // Implementation of the Logger interface for logging messages to a file
  class FileLogger implements Logger
  {
    // Private property to store the path to the log file
    private $logFile;

    // Constructor to initialize the log file path
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
        // Write the current date and time, message, and a newline character to the file
        fwrite($file, date('Y-m-d H:i:s') . ' - ' . $message . "\n");
        // Close the file
        fclose($file);
      } else {
        // Display an error message if unable to open the log file for writing
        echo "Error: Unable to open log file for writing.";
      }
    }
  }

  // Implementation of the Logger interface for logging messages to a database
  class DatabaseLogger implements Logger
  {
    // Private property to store the PDO object for database connection
    private $pdo;

    // Constructor to initialize the PDO object
    public function __construct($pdo)
    {
      $this->pdo = $pdo;
    }

    // Method to log a message to the database
    public function log($message)
    {
      // Get the current timestamp
      $currentTimestamp = date('Y-m-d H:i:s');
      // Prepare a SQL statement to insert the log message into the database
      $statement = $this->pdo->prepare("INSERT INTO logs (timestamp, message) VALUES (:timestamp, :message)");
      // Bind the current timestamp to the SQL statement
      $statement->bindParam(':timestamp', $currentTimestamp);
      // Bind the message to the SQL statement
      $statement->bindParam(':message', $message);
      // Execute the SQL statement
      $result = $statement->execute();
      if (!$result) {
        // Display an error message if failed to log the message to the database
        echo "Error: Failed to log message to the database.";
      }
    }
  }

  // Create a FileLogger instance for logging messages to a file
  $fileLogger = new FileLogger('logfile.txt');
  // Log a message to the file using the FileLogger instance
  $fileLogger->log("This is a message logged to a file.");

  // Create a DatabaseLogger instance for logging messages to the MySQL database
  $databaseLogger = new DatabaseLogger($pdo);
  // Log a message to the database using the DatabaseLogger instance
  $databaseLogger->log("This is a message logged to a database.");

} catch (PDOException $e) {
  // Display error message if connection fails
  echo "Connection failed: " . $e->getMessage();
}

/*Encapsulation in object-oriented programming is the concept of bundling the data (attributes) and methods (functions) that operate on the data into a single unit, called a class. It allows the internal state of an object to be accessed and modified only through well-defined interfaces (methods), while hiding the implementation details from the outside world. In the context of the above PHP codes, encapsulation is demonstrated as follows:

  1. Private Properties: In both the FileLogger and DatabaseLogger classes, properties like $logFile and $pdo are declared as private. This means these properties are only accessible within their respective classes and cannot be directly accessed or modified from outside.
  
  2. Constructor: The constructor method (__construct) in both classes is used to initialize the private properties ($logFile and $pdo). This ensures that these properties are properly initialized when an object of the class is created.
  
  3. Public Methods: The log() method in both classes is declared as public, meaning it can be accessed from outside the class. This method provides an interface for external code to interact with the class. However, the actual implementation details (such as file handling or database operations) are hidden within the class.
  
  
  In summary, encapsulation in these PHP codes ensures that the internal workings of the FileLogger and DatabaseLogger classes are hidden from the outside, allowing them to be used securely and providing a clear and consistent interface for logging messages.
  */