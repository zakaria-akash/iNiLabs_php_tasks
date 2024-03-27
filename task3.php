<?php

class Employee
{
  // Static property to hold the single instance of the class
  private static $instance;

  // Private properties to store employee name and salary
  private $name;
  private $salary;

  // Private constructor to prevent instantiation from outside the class
  private function __construct($name, $salary)
  {
    $this->name = $name; // Initialize employee name
    $this->setSalary($salary); // Initialize employee salary securely
  }

  // Static method to get the single instance of the class
  public static function getInstance($name, $salary)
  {
    // Check if an instance of the class already exists
    if (!isset(self::$instance)) {
      // If no instance exists, create a new one
      self::$instance = new self($name, $salary);
    }
    // Return the single instance of the class
    return self::$instance;
  }

  // Setter method to set salary securely
  public function setSalary($salary)
  {
    // Ensure that salary is a positive number
    if ($salary >= 0) {
      $this->salary = $salary;
    } else {
      // Display an error message if salary is negative
      echo "Error: Salary must be a positive number.";
    }
  }

  // Getter method to get employee's name
  public function getName()
  {
    return $this->name;
  }

  // Getter method to get employee's salary
  public function getSalary()
  {
    return $this->salary;
  }
}

// Create an instance of the Employee class using the getInstance method (Singleton pattern)
$employee1 = Employee::getInstance("John", 50000);

// Output employee's name and salary
echo "Employee Name: " . $employee1->getName() . "<br>";
echo "Employee Salary: $" . $employee1->getSalary() . "<br>";

// Attempt to set a negative salary (will result in an error)
$employee1->setSalary(-1000);

// Output employee's salary after attempting to set a negative value
echo "Employee Salary after invalid modification: $" . $employee1->getSalary() . "<br>";

// Create another instance of the Employee class (should return the same instance as $employee1)
$employee2 = Employee::getInstance("Jane", 60000);

// Output name and salary of the new instance (should match $employee1)
echo "Employee Name (New Instance): " . $employee2->getName() . "<br>";
echo "Employee Salary (New Instance): $" . $employee2->getSalary() . "<br>";


/*Encapsulation: Encapsulation is the bundling of data and methods that operate on the data into a single unit or class, while restricting access to some of the object's components. It aims to protect the internal state of an object and only expose necessary functionality through well-defined interfaces.*/
/*Singleton Design Pattern: The Singleton Design Pattern ensures that a class has only one instance and provides a global point of access to that instance. It involves a class that is responsible for creating and managing its own single instance and ensuring that no other instance of the class can be created.*/

/*In the context of the above PHP codes, "Encapsulation" & "Singleton Design Pattern" is demonstrated as follows:
#Encapsulation:
--The Employee class encapsulates the employee's data (name and salary) and functionality (setter and getter methods) within a single unit.
--The properties $name and $salary are declared as private, encapsulating them and preventing direct access from outside the class.
--The setSalary() method encapsulates the logic for setting the salary securely, ensuring that only positive values are accepted.
--Getter methods getName() and getSalary() encapsulate the access to the employee's name and salary, respectively, allowing controlled access to these properties.

#Singleton Design Pattern:
--The Employee class implements the Singleton pattern using a static method getInstance().
--The constructor of the Employee class is made private, preventing external instantiation of the class.
--The getInstance() method ensures that only one instance of the Employee class exists throughout the application's lifecycle by controlling the creation of new instances.
--When getInstance() is called for the first time, it creates a new instance of the class. Subsequent calls return the same instance, ensuring that there is only one instance of the Employee class.
--This pattern is demonstrated by creating multiple instances ($employee1 and $employee2) using the getInstance() method, and both instances refer to the same object, enforcing the Singleton behavior.
*/