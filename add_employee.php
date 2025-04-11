<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();
include('includes/header.php');

$error = '';

if(isset($_POST['FirstName']))
{
    if(empty($_POST['FirstName']) || empty($_POST['LastName']) || empty($_POST['Sin']) || empty($_POST['position'])) {
        $error = 'All fields are required';
    } elseif(!is_numeric($_POST['Sin'])) {
        $error = 'SIN must be a number';
    } else {
        $query = 'INSERT INTO Employees 
                  (FirstName, LastName, Sin, position) 
                  VALUES (
                      "'.mysqli_real_escape_string($connect, $_POST['FirstName']).'",
                      "'.mysqli_real_escape_string($connect, $_POST['LastName']).'",
                      "'.mysqli_real_escape_string($connect, $_POST['Sin']).'",
                      "'.mysqli_real_escape_string($connect, $_POST['position']).'"
                  )';
        
        if(mysqli_query($connect, $query)) {
            header('Location: employees.php?success=Employee added');
            die();
        } else {
            $error = 'Failed to add employee';
        }
    }
}
?>

<div class="container">
    <h2>Add New Employee</h2>
    
    <?php if($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form method="post">
        <div class="mb-3">
            <label for="FirstName" class="form-label">First Name</label>
            <input type="text" class="form-control" name="FirstName" id="FirstName" required>
        </div>
        
        <div class="mb-3">
            <label for="LastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" name="LastName" id="LastName" required>
        </div>
        
        <div class="mb-3">
            <label for="Sin" class="form-label">SIN (Social Insurance Number)</label>
            <input type="text" class="form-control" name="Sin" id="Sin" required>
        </div>
        
        <div class="mb-3">
            <label for="position" class="form-label">Position</label>
            <input type="text" class="form-control" name="position" id="position" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Add Employee</button>
        <a href="employees.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include('includes/footer.php'); ?>