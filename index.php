<?php 
include('includes/database.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="styles.css" rel="stylesheet">
</head>
<body>

<h1>Welcome to National Museum</h1>

<a href="signin.php">Login</a>
<a href="signup.php">Sign Up</a>

<h2>Upcoming Events</h2>

<div class="tours-list">
    <?php
    $query = 'SELECT Tours.*, Employees.FirstName, Employees.LastName 
              FROM Tours 
              LEFT JOIN Employees ON Tours.tourguide = Employees.Id 
              ORDER BY tourDate DESC';
    $result = mysqli_query($connect, $query);
    
    while($tour = mysqli_fetch_assoc($result)) {
        echo '
        <div class="tour-card">
            <h3>'.htmlspecialchars($tour['title']).'</h3>
            <p>Date: '.date('F j, Y g:i a', strtotime($tour['tourDate'])).'</p>
            <p>Audience: '.htmlspecialchars($tour['audience']).'</p>
            <p>Guide: '.htmlspecialchars($tour['FirstName']).' '.htmlspecialchars($tour['LastName']).'</p>
        </div>';
    }
    ?>
</div>

