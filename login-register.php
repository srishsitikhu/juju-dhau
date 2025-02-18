<?php
@session_start();
include 'database/connect.php';


if (isset($_POST['sign_up'])) {
    // Collecting user input
    $name = $_POST['userName'];
    $email = $_POST['userEmail'];
    $password = $_POST['userPassword'];
    $contact = $_POST['userContact'];
    $address = $_POST['userAddress'];

    // Prepare the SQL query
    $sql = "INSERT INTO user (name, email, password, number, address) VALUES ('$name', '$email', '$password', '$contact', '$address')";

    // Attempt to execute the query
    if ($conn->query($sql) === TRUE) {
        // Registration successful
        header("Location: index.php?notify=1");
    } 
}

if (isset($_POST['sign_in'])) {
    $email = $_POST['userEmail'];
    $password = $_POST['userPassword'];

    // Prepare SQL query
    $sql = "SELECT id, name, password FROM user WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];

        // Verify the password
        if ($storedPassword === $password) {
            $_SESSION['name'] = $row['name'];
            $_SESSION['userid'] = $row['id']; // Set the userid in session

            header("Location: index.php?notify=2");
            exit();
        } else {
            header("Location: form-box.php?notify=3");
            exit();

        }
    } else {
        header("Location: form-box.php?notify=3");
        exit();

    }
}
