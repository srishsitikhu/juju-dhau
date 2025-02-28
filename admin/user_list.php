<?php
// Start session at the top before any output
@session_start();

// Check if the admin session exists
if (!isset($_SESSION['admin'])) {
    // Redirect to login page if session is invalid
    header('Location: login/login.php');
    exit;
}

// Include header
include 'header.php';
// Include database connection
include '../database/connect.php';

// Fetch data from the user table
$sql = "SELECT * FROM user";
$result = $conn->query($sql);
?>

    <div class="container-fluid">
        <div class="row">
            <!-- Include Sidebar -->
            <?php include 'sidebar.php'; ?>

            <!-- Main Content -->
            <div class="main-content-user">
                <h2 class="my-4">Customer List</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Number</th>
                                <th>Address</th>
                                <th>Action</th> <!-- New Action Column -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "
                                    <tr>
                                        <td>{$row['id']}</td>
                                        <td>{$row['name']}</td>
                                        <td>{$row['number']}</td>
                                        <td>{$row['address']}</td>
                                        <td>
                                            <a href='edit_user.php?id={$row['id']}' class='btn btn-warning btn-sm'>Update</a>
                                            <a href='delete_user.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                                        </td>
                                    </tr>
                                    ";
                                }
                            } else {
                                echo "<tr><td colspan='7' class='text-center'>No users found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php'; ?>