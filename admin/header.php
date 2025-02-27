<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="../css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="../js/jquery.js"></script>
    <?php
    // Start session at the top before any output
    @session_start();

    // Check if the admin session exists
    if (!isset($_SESSION['admin'])) {
        // Redirect to login page if session is invalid
        header('Location: login/login.php');
        exit;
    }
    ?>
</head>
<body>
<?php
include('asset/notify.php');   
?>
