<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Valid Parentheses Checker</title>
</head>

<body>
  <h1>Valid Parentheses Checker</h1>
  <form method="post">
    <label for="parentheses_input">Enter a string:</label>
    <input type="text" id="parentheses_input" name="parentheses_input">
    <button type="submit">Check</button>
  </form>

  <?php
  // Function to check if the given string has valid parentheses
  function isValidParentheses($s)
  {
    // Check if the input string is empty
    if (empty ($s)) {
      return "Empty Input";
    }

    // Initialize an empty stack to store opening parentheses
    $stack = [];
    // Define a mapping of closing parentheses to their corresponding opening parentheses
    $map = [
      ')' => '(',
      ']' => '[',
      '}' => '{'
    ];

    // Loop through each character in the input string
    for ($i = 0; $i < strlen($s); $i++) {
      $char = $s[$i];
      // If the character is a closing parenthesis
      if (array_key_exists($char, $map)) {
        // Pop the top element from the stack, or '#' if the stack is empty
        $topElement = empty ($stack) ? '#' : array_pop($stack);
        // If the popped element is not the corresponding opening parenthesis
        if ($topElement != $map[$char]) {
          // Return false, indicating invalid parentheses
          return "False";
        }
      } elseif (!in_array($char, ['(', ')', '[', ']', '{', '}'])) {
        // If the character is not a parenthesis
        // Return "Invalid Input" if the input contains characters other than parentheses
        return "Invalid Input";
      } else {
        // If the character is an opening parenthesis, push it onto the stack
        array_push($stack, $char);
      }
    }

    // After looping through the entire string, check if the stack is empty
    // If the stack is empty, all opening parentheses have been matched with closing ones
    // Return true if the stack is empty, indicating valid parentheses
    return empty ($stack) ? "True" : "Invalid Input";
  }

  // Check if the request method is POST
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the input string from the form submission
    $input = $_POST["parentheses_input"];
    // Call the isValidParentheses function to check if the input string has valid parentheses
    $result = isValidParentheses($input);
    // Display the result based on whether the parentheses are valid or not
    echo "<p>Output: $result</p>";
  }
  ?>
</body>

</html>