
<?php
$con = mysqli_connect("localhost", "root", "", "phpcrud");

if (mysqli_connect_errno()) {
    die("Connection Failed: " . mysqli_connect_error());
}

echo "Database connected successfully!";
?>
