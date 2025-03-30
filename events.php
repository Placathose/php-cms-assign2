<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure(); // Restrict access to logged-in users
include('includes/header.php');

if (isset($_GET['delete'])) {
  if ($stmt = mysqli_prepare($connect, 'DELETE FROM Events WHERE Id = ? LIMIT 1')) {
      mysqli_stmt_bind_param($stmt, 'i', $_GET['delete']);
      mysqli_stmt_execute($stmt);
      set_message('Event deleted');
      header('Location: events.php');
      die();
  }
}
?>

<div class="container">
  <h2>Museum Events</h2>
  <a href="add_event.php" class="btn btn-primary">Add New Event</a>

  <div>
    <?php
      $query = 'SELECT * FROM Events ORDER BY Id DESC';
      // send a query to Events and get an object response
      $result = mysqli_query($connect, $query);

      // loop through each row from Events 
      // need limit add it to query
      while($event = mysqli_fetch_assoc($result)){
        echo '
        <div class="event-card">
            <h3>'.htmlspecialchars($event['title']).' | '.htmlspecialchars($event['tickets']). '</h3>
            <p>Date: '.date('F j, Y', strtotime($event['eventDate'])).'</p>
            <p>'.htmlspecialchars($event['description']).'</p>
            <div class="event-actions">
              <a href="edit_event.php?id='.(int)$event['Id'].'" class="edit-btn">Edit</a>
              <a href="events.php?delete='.(int)$event['Id'].'" 
                onclick="return confirm(\'Permanently delete this event?\')" 
                class="delete-btn">Delete</a>
            </div>
        </div>';
      }
    ?>
  </div>
</div>

<?php include('includes/footer.php'); ?>