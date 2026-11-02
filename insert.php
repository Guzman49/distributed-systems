
<?php
include('dbconnection.php');

$message = "";

if (isset($_POST['submit'])) {

    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $contno = trim($_POST['contactno']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);

    // Prepared statement to safely insert data
    $stmt = mysqli_prepare(
        $con,
        "INSERT INTO tblusers
        (FirstName, LastName, MobileNumber, Email, Address)
        VALUES (?, ?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "sssss",
        $fname,
        $lname,
        $contno,
        $email,
        $address
    );

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php?success=1");
        exit();
    } else {
        $message = "Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>

    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow mx-auto" style="max-width: 600px;">

        <div class="card-header bg-success text-white">
            <h3>Register New User</h3>
        </div>

        <div class="card-body">

            <?php if ($message != ""): ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <form method="POST">

                <div class="mb-3">
                    <label>First Name</label>
                    <input type="text" name="fname"
                    class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Last Name</label>
                    <input type="text" name="lname"
                    class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Mobile Number</label>
                    <input type="tel" name="contactno"
                    class="form-control" maxlength="10"
                    pattern="[0-9]{10}" required>
                </div>

                <div class="mb-3">
                    <label>Email Address</label>
                    <input type="email" name="email"
                    class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Address</label>
                    <textarea name="address"
                    class="form-control" required></textarea>
                </div>

                <button type="submit" name="submit"
                class="btn btn-success w-100">
                    Submit
                </button>

            </form>

            <div class="text-center mt-3">
                <a href="index.php">View Registered Users</a>
            </div>

        </div>
    </div>
</div>

</body>
</html>
