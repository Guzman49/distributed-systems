
<?php

include('dbconnection.php');

// Allow POST requests only
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request.");
}

// Validate the user ID
if (!isset($_POST['deleteid']) || !ctype_digit($_POST['deleteid'])) {
    die("Invalid user ID.");
}

$deleteid = (int) $_POST['deleteid'];

// Delete the selected user using a prepared statement
$stmt = mysqli_prepare($con, "DELETE FROM tblusers WHERE ID = ?");

if (!$stmt) {
    die("Database error: " . mysqli_error($con));
}

mysqli_stmt_bind_param($stmt, "i", $deleteid);

if (mysqli_stmt_execute($stmt)) {

    mysqli_stmt_close($stmt);

    header("Location: index.php?deleted=1");
    exit();

} else {

    die("Delete failed: " . mysqli_stmt_error($stmt));

}

?>