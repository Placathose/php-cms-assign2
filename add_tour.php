<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();
include('includes/header.php');

// Handle form submission
if (isset($_POST['add_tour'])) {
    $query = 'INSERT INTO Tours (
        title, 
        tourDate, 
        audience, 
        tourguide
    ) VALUES (
        "'.mysqli_real_escape_string($connect, $_POST['title']).'",
        "'.mysqli_real_escape_string($connect, $_POST['tourDate']).'",
        "'.mysqli_real_escape_string($connect, $_POST['audience']).'",
        "'.mysqli_real_escape_string($connect, $_POST['tourguide']).'"
    )';
    
    mysqli_query($connect, $query);
    set_message('Tour added successfully!');
    header('Location: tours.php');
    die();
}

// Fetch all employees for dropdown
$employees_query = 'SELECT Id, FirstName, LastName, position FROM Employees ORDER BY LastName';
$employees_result = mysqli_query($connect, $employees_query);
?>

<div class="container">
    <h2>Add New Tour</h2>
    <form method="post">
        <label>Tour Title:</label>
        <input type="text" name="title" required>

        <label>Date & Time:</label>
        <input type="datetime-local" name="tourDate" required>

        <label>Target Audience:</label>
        <input type="text" name="audience" placeholder="e.g., School Groups, Seniors, Families">

        <label>Tour Guide:</label>
        <select name="tourguide" required>
            <option value="">-- Select Guide --</option>
            <?php while($employee = mysqli_fetch_assoc($employees_result)): ?>
                <option value="<?php echo $employee['Id']; ?>">
                    <?php echo htmlspecialchars($employee['FirstName'].' '.$employee['LastName'].' ('.$employee['position'].')'); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <button type="submit" name="add_tour">Add Tour</button>
        <a href="tours.php" class="cancel-btn">Cancel</a>
    </form>
</div>

<?php include('includes/footer.php'); ?>