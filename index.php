<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
include('includes/header.php');

if(isset($_POST['email']))
{
  // check if email and password match
  $query = 'SELECT * FROM Users
    WHERE email = "'.$_POST['email'].'"
    AND password = "'.md5($_POST['password']).'"
    AND active = "yes"
    LIMIT 1';

  $result = mysqli_query($connect, $query);

  // Check if num of rows > 0
  if(mysqli_num_rows($result))
  {
    $record = mysqli_fetch_assoc($result);
    $_SESSION['Id'] = $record['Id'];
    $_SESSION['email'] = $record['email'];

    // Redirect to dashboard
    header('Location: dashboard.php');
    die();
  }

}
?>

<div style="max-width: 400px; margin:auto">

  <form method="post">

    <label for="email">Email:</label>
    <input type="text" name="email" id="email">

    <br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password">

    <br>

    <input type="submit" value="Login">

  </form>
  
</div>