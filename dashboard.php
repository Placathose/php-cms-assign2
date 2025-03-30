<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

secure();

include('includes/header.php');

?>

<h2>Dashboard</h2>

<a href="tours.php">Manage Tours</a>
<a href="users.php">Manage users</a>
<a href="events.php">Check the events</a>

<?php

include('includes/footer.php')
?>