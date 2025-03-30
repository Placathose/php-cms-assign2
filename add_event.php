<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure(); // Restrict to logged-in users
include('includes/header.php');

// Handle form submission
// check if button with name=add_event was clicked
if (isset($_POST['add_event'])) {
  $query = 'INSERT INTO Events (
      title, 
      eventDate, 
      tickets, 
      description, 
      image
  ) VALUES (
      "'.mysqli_real_escape_string($connect, $_POST['title']).'",
      "'.mysqli_real_escape_string($connect, $_POST['eventDate']).'",
      "'.mysqli_real_escape_string($connect, $_POST['tickets']).'",
      "'.mysqli_real_escape_string($connect, $_POST['description']).'",
      "'.mysqli_real_escape_string($connect, $_POST['image']).'"
  )';
  
  mysqli_query($connect, $query);
  set_message('Event added successfully!');
  header('Location: events.php');
  die();
}
?>

<div class="container">
    <h2>Add New Event</h2>
    <form method="post">
        <label>Title:</label>
        <input type="text" name="title" required>

        <label>Date/Time:</label>
        <input type="datetime-local" name="eventDate" required>

        <label>Ticket Info:</label>
        <input type="text" name="tickets" placeholder="e.g., Free, $20, etc.">

        <label>Description:</label>
        <textarea name="description" rows="4"></textarea>

        <label>Image URL:</label>
        <input type="text" name="image" placeholder="e.g., event.jpg">

        <button type="submit" name="add_event">Add Event</button>
        <a href="events.php" class="cancel-btn">Cancel</a>
    </form>
</div>


<?php include('includes/footer.php'); ?>