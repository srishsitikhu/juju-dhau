<?php
@session_start();
session_unset(); // Clear all session variables
session_destroy(); // Destroy the session
echo "<script>window.location.href = 'index.php?notify=5';</script>"; // Redirect to login page
?>
