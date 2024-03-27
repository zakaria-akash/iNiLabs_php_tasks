/*
**Task 1: Class Inheritance**
Create classes to represent geometric shapes, including circles and rectangles. Implement methods for area calculation.
You can use the provided example code as a reference.
*/
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shape Area Calculator</title>
</head>

<body>
  <h1 style="margin: 1rem;">Shape Area Calculator</h1>
  <form method="post">
    <label for="shape_select" style="margin: 1rem;">Select Shape:</label>
    <select id="shape_select" name="shape" style="margin: 1rem;">
      <option selected value="0">Select Shape</option>
      <option value="circle">Circle</option>
      <option value="rectangle">Rectangle</option>
    </select>
    <div id="inputs">
      <!-- Input fields for radius -->
      <div id="radius_input" style="display: none; margin: 1rem;">
        <label for="radius">Radius:</label>
        <input type="number" id="radius" name="radius" step="any" />
      </div>
      <!-- Input fields for width and height -->
      <div id="rectangle_input" style="display: none; margin: 1rem;">
        <label for="width">Width:</label>
        <input type="number" id="width" name="width" step="any" />
        <label for="height">Height:</label>
        <input type="number" id="height" name="height" step="any" />
      </div>
    </div>
    <button type="submit" style="margin: 1rem;">Calculate</button>
  </form>

  <?php
  // Define a base class for geometric shapes
  class Shape
  {
    // Define a method to calculate the area
    public function calculateArea()
    {
      // Default area calculation method returns 0
      return 0;
    }
  }

  // Define a subclass for circles, inheriting from Shape
  class Circle extends Shape
  {
    private $radius; // Private property to store the radius of the circle
  
    // Constructor to initialize the radius
    public function __construct($radius)
    {
      $this->radius = $radius; // Assign the provided radius to the object's radius property
    }

    // Override the calculateArea method to calculate the area of a circle
    public function calculateArea()
    {
      // Calculate the area of the circle using the formula: π * r^2
      return M_PI * pow($this->radius, 2);
    }
  }

  // Define a subclass for rectangles, inheriting from Shape
  class Rectangle extends Shape
  {
    private $width; // Private property to store the width of the rectangle
    private $height; // Private property to store the height of the rectangle
  
    // Constructor to initialize width and height
    public function __construct($width, $height)
    {
      $this->width = $width; // Assign the provided width to the object's width property
      $this->height = $height; // Assign the provided height to the object's height property
    }

    // Override the calculateArea method to calculate the area of a rectangle
    public function calculateArea()
    {
      // Calculate the area of the rectangle using the formula: width * height
      return $this->width * $this->height;
    }
  }

  // PHP code to handle form submission and calculate area
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a shape option is selected
    if (isset($_POST["shape"])) {
      // Initialize area to 0
      $area = 0;
      // Get the selected shape from the form data
      $shape = $_POST["shape"];
      // Check if the selected shape is a circle
      if ($shape == "circle") {
        // Check if the radius is provided
        if (isset($_POST["radius"])) {
          // Create a new Circle object with the provided radius
          $radius = $_POST["radius"];
          $circle = new Circle($radius);
          // Calculate the area of the circle
          $area = $circle->calculateArea();
        }
      }
      // Check if the selected shape is a rectangle
      if ($shape == "rectangle") {
        // Check if both width and height are provided
        if (isset($_POST["width"]) && isset($_POST["height"])) {
          // Create a new Rectangle object with the provided width and height
          $width = $_POST["width"];
          $height = $_POST["height"];
          $rectangle = new Rectangle($width, $height);
          // Calculate the area of the rectangle
          $area = $rectangle->calculateArea();
        }
      }

      // Display the calculated area
      echo "<p style='margin: 1rem;'>Area Calculated: $area</p>";
    }
  }
  ?>


  <script>
    // JavaScript to show/hide input fields based on selected shape
    document.getElementById('shape_select').addEventListener('change', function () {
      var shape = this.value;
      var radiusInput = document.getElementById('radius_input');
      var rectangleInput = document.getElementById('rectangle_input');

      if (shape === 'circle') {
        radiusInput.style.display = 'block';
        rectangleInput.style.display = 'none';
      } else if (shape === 'rectangle') {
        radiusInput.style.display = 'none';
        rectangleInput.style.display = 'block';
      }
    });
  </script>
</body>

</html>