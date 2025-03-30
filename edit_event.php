<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure(); // Restrict to logged-in users
include('includes/header.php');

// Fetch existing event data
if (isset($_GET['id'])) {
    $query = 'SELECT * FROM Events WHERE Id = '.(int)$_GET['id'];
    $result = mysqli_query($connect, $query);
    $event = mysqli_fetch_assoc($result);
}

// Handle form submission
if (isset($_POST['update_event'])) {
    $query = 'UPDATE Events SET 
        title = "'.mysqli_real_escape_string($connect, $_POST['title']).'",
        eventDate = "'.mysqli_real_escape_string($connect, $_POST['eventDate']).'",
        tickets = "'.mysqli_real_escape_string($connect, $_POST['tickets']).'",
        description = "'.mysqli_real_escape_string($connect, $_POST['description']).'",
        image = "'.mysqli_real_escape_string($connect, $_POST['image']).'"
    WHERE Id = '.(int)$_POST['id'];
    
    mysqli_query($connect, $query);
    set_message('Event updated successfully!');
    header('Location: events.php');
    die();
}

if (!isset($event)) {
    set_message('Event not found');
    header('Location: events.php');
    die();
}
?>

<div class="container">
    <h2>Edit Event</h2>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $event['Id']; ?>">
        
        <label>Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($event['title']); ?>" required>

        <label>Date/Time:</label>
        <input type="datetime-local" name="eventDate" 
               value="<?php echo date('Y-m-d\TH:i', strtotime($event['eventDate'])); ?>" required>

        <label>Ticket Info:</label>
        <input type="text" name="tickets" value="<?php echo htmlspecialchars($event['tickets']); ?>" 
               placeholder="e.g., Free, $20, etc.">

        <label>Description:</label>
        <textarea name="description" rows="4"><?php echo htmlspecialchars($event['description']); ?></textarea>

        <label>Image URL:</label>
        <input type="text" name="image" value="<?php echo htmlspecialchars($event['image']); ?>" 
               placeholder="e.g., event.jpg">

        <button type="submit" name="update_event">Update Event</button>
        <a href="events.php" class="cancel-btn">Cancel</a>
    </form>
</div>

<?php include('includes/footer.php'); 