<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();
include('includes/header.php');
?>

<div class="container">
    <h2>Museum Tours</h2>
    <a href="add_tour.php" class="btn btn-primary">Add New Tour</a>

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
                <a href="edit_tour.php?id='.$tour['Id'].'" class="edit-btn">Edit</a>
                <a href="tours.php?delete='.$tour['Id'].'" onclick="return confirm(\'Delete this tour?\')" class="delete-btn">Delete</a>
            </div>';
        }
        ?>
    </div>
</div>

<?php include('includes/footer.php'); ?>