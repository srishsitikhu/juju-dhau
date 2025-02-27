<?php
// Start session at the top before any output
@session_start();

include 'header.php';
// Include database connection
include '../database/connect.php';

// Fetch data from the contact_us table
$sql = "SELECT * FROM contact_us";
$result = $conn->query($sql);
?>
    <div class="container-fluid">
        <div class="d-flex gap-3">
            <!-- Include Sidebar -->
            <?php include 'sidebar.php'; ?>

            <!-- Main Content -->
            <div class="main-content-contact">
                <h2 class="my-4">Contact Messages</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Created At</th>
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
                                        <td>{$row['email']}</td>
                                        <td>{$row['message']}</td>
                                        <td>{$row['created_at']}</td>
                                    </tr>
                                    ";
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>No messages found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php'; ?>
