
<?php
include('dbconnection.php');

// Retrieve all registered users
$query = mysqli_query($con, "SELECT * FROM tblusers ORDER BY ID DESC");

if (!$query) {
    die("Database query failed: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registered Users</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3>Registered Users</h3>
            <p class="mb-0">PHP and MySQL CRUD Application</p>
        </div>

        <div class="card-body">

            <!-- Registration success message -->
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success">
                    User registered successfully!
                </div>
            <?php endif; ?>

            <!-- Update success message -->
            <?php if (isset($_GET['updated'])): ?>
                <div class="alert alert-success">
                    User details updated successfully!
                </div>
            <?php endif; ?>

            <!-- Delete success message -->
            <?php if (isset($_GET['deleted'])): ?>
                <div class="alert alert-success">
                    User deleted successfully!
                </div>
            <?php endif; ?>

            <!-- Add user button -->
            <a href="insert.php" class="btn btn-success mb-3">
                + Add New User
            </a>

            <div class="table-responsive">

                <table class="table table-bordered table-striped table-hover">

                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Mobile Number</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Creation Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (mysqli_num_rows($query) > 0): ?>

                            <?php while ($row = mysqli_fetch_assoc($query)): ?>

                                <tr>

                                    <td>
                                        <?php echo htmlspecialchars($row['ID']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($row['FirstName']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($row['LastName']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($row['MobileNumber']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($row['Email']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($row['Address']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($row['CreationDate']); ?>
                                    </td>

                                    <td>

                                        <!-- View button -->
                                        <a href="read.php?viewid=<?php echo (int)$row['ID']; ?>"
                                           class="btn btn-info btn-sm mb-1">
                                            View
                                        </a>

                                        <!-- Edit button -->
                                        <a href="edit.php?editid=<?php echo (int)$row['ID']; ?>"
                                           class="btn btn-warning btn-sm mb-1">
                                            Edit
                                        </a>

                                        <!-- Delete button -->
                                        <form action="delete.php"
                                              method="POST"
                                              style="display:inline;"
                                              onsubmit="return confirm('Are you sure you want to delete this user?');">

                                            <input type="hidden"
                                                   name="deleteid"
                                                   value="<?php echo (int)$row['ID']; ?>">

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm mb-1">
                                                Delete
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            <?php endwhile; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="8" class="text-center">
                                    No registered users found.
                                </td>
                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

        <div class="card-footer text-center text-muted">
            Distributed Systems Practical Assignment
        </div>

    </div>

</div>

</body>
</html>
