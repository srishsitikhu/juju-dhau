<?php
include '../database/connect.php';

// Handle form submission
$id = $_GET['Id'];
$sql = "UPDATE orders SET status='Paid' WHERE id = $id";
$result = $conn->query($sql);

if ($result) {
    echo "<script>
          alert('Order status updated successfully');
          window.location.href='customer.php';
          </script>";
} else {
    echo "<script>
          alert('Error updating order status');
          window.location.href='customer.php';
          </script>";
}

$conn->close();
?>