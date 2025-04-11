<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

$error = '';
$success = '';

if(isset($_POST['email']))
{
    // Validate input
    if(empty($_POST['email']) || empty($_POST['password']) || empty($_POST['firstname']) || empty($_POST['lastname'])) {
        $error = 'All fields are required';
    } elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format';
    } else {
        // Check if email already exists
        $query = 'SELECT * FROM Users WHERE email = "'.mysqli_real_escape_string($connect, $_POST['email']).'" LIMIT 1';
        $result = mysqli_query($connect, $query);
        
        if(mysqli_num_rows($result)) {
            $error = 'Email already registered';
        } else {
            // Hash the password
            $hashed_password = md5($_POST['password']);
            
            // Insert new user
            $query = 'INSERT INTO Users 
                      (firstname, lastname, email, password, active, dateAdded) 
                      VALUES (
                          "'.mysqli_real_escape_string($connect, $_POST['firstname']).'",
                          "'.mysqli_real_escape_string($connect, $_POST['lastname']).'",
                          "'.mysqli_real_escape_string($connect, $_POST['email']).'",
                          "'.$hashed_password.'",
                          "yes",
                          NOW()
                      )';
            
            if(mysqli_query($connect, $query)) {
                $success = 'Account created successfully! You can now <a href="index.php">login</a>.';
            } else {
                $error = 'Registration failed. Please try again.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up - Museum Tour</title>
  <link href="styles.css" rel="stylesheet">
</head>
<body>

<h1>Sign Up for Museum Tour</h1>

<div style="max-width: 400px; margin:auto">

  <?php if($error): ?>
    <div style="color: red; padding: 10px; margin-bottom: 10px; border: 1px solid red;">
      <?php echo $error; ?>
    </div>
  <?php endif; ?>
  
  <?php if($success): ?>
    <div style="color: green; padding: 10px; margin-bottom: 10px; border: 1px solid green;">
      <?php echo $success; ?>
    </div>
  <?php else: ?>

    <form method="post">

      <label for="firstname">First Name:</label>
      <input type="text" name="firstname" id="firstname" required>


      <label for="lastname">Last Name:</label>
      <input type="text" name="lastname" id="lastname" required>


      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required>


      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required>


      <input type="submit" value="Sign Up">
    </form>

  <?php endif; ?>

  <p class="signup">Already have an account?</p>
  <a href="index.php">Login</a>
  
</div>

</body>
</html>