<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();
include('includes/header.php');

// Handle delete operation
if(isset($_GET['delete'])) {
    $delete_query = 'DELETE FROM Employees WHERE Id = '.intval($_GET['delete']);
    if(mysqli_query($connect, $delete_query)) {
        $_SESSION['success'] = "Employee deleted successfully";
    } else {
        $_SESSION['error'] = "Failed to delete employee";
    }
    header('Location: employees.php');
    die();
}

// Display success/error messages
if(isset($_SESSION['success'])) {
    echo '<div class="alert alert-success">'.$_SESSION['success'].'</div>';
    unset($_SESSION['success']);
}
if(isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger">'.$_SESSION['error'].'</div>';
    unset($_SESSION['error']);
}
?>

<div class="container">
    <h2>Employee Management</h2>
    <a href="add_employee.php" class="btn btn-primary mb-3">Add New Employee</a>

    <div class="table-responsive mt-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>SIN</th>
                    <th>Position</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = 'SELECT * FROM Employees ORDER BY LastName, FirstName';
                $result = mysqli_query($connect, $query);
                
                while($employee = mysqli_fetch_assoc($result)) {
                    echo '
                    <tr>
                        <td>'.$employee['Id'].'</td>
                        <td>'.htmlspecialchars($employee['FirstName']).'</td>
                        <td>'.htmlspecialchars($employee['LastName']).'</td>
                        <td>'.htmlspecialchars($employee['Sin']).'</td>
                        <td>'.htmlspecialchars($employee['position']).'</td>
                        <td>
                            <a href="edit_employee.php?id='.$employee['Id'].'" class="btn btn-sm btn-warning">Edit</a>
                            <a href="employees.php?delete='.$employee['Id'].'" onclick="return confirm(\'Are you sure you want to delete this employee?\')" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('includes/footer.php'); ?>