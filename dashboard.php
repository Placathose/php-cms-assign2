<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

secure();

include('includes/header.php');

?>

<style>
  .dashboard-hero {
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0,0,0,0.7)),
                url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e') center/cover no-repeat;
    padding: 100px 30px;
    color: white;
    text-align: center;
    border-radius: 16px;
    margin-bottom: 30px;
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
    animation: fadeIn 1.2s ease;
  }

  .dashboard-hero h1 {
    font-size: 3em;
    margin-bottom: 10px;
  }

  .dashboard-hero p {
    font-size: 1.2em;
    opacity: 0.9;
  }

  .dashboard-links {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    margin-top: 40px;
    gap: 20px;
  }

  .dashboard-link {
    flex: 1 1 28%;
    background: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    text-align: center;
    transition: all 0.3s ease;
    text-decoration: none;
    color: #333;
    font-weight: bold;
    font-size: 1.2em;
    animation: slideUp 0.6s ease;
  }

  .dashboard-link:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
    color: #00796b;
  }

  @media (max-width: 768px) {
    .dashboard-link {
      flex: 1 1 100%;
    }

    .dashboard-hero h1 {
      font-size: 2em;
    }
  }
</style>

<div class="container">
  <div class="dashboard-hero">
    <h1>Welcome to Your Dashboard</h1>
    <p>Use the links below to manage your tours, events, and users.</p>
  </div>

  <div class="dashboard-links">
    <a class="dashboard-link" href="tours.php">Manage Tours</a>
    <a class="dashboard-link" href="employees.php">Manage Employees</a>
    <a class="dashboard-link" href="events.php">Check the Events</a>
  </div>
</div>

<h2>Upcoming Tours</h2>

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

<?php include('includes/footer.php'); ?>
