<?php
if (isset($_GET['notify'])) {
    // Notifications data (message, icon, and icon color)
    $notifications = [
        1 => ["Login Successful", "fas fa-check-circle", "green"],
        2 => ["Invalid email or password", "fas fa-times-circle", "red"],
        3 => ["Logout Successful", "fas fa-sign-out-alt", "red"],
        4 => ["Product removed successfully", "fas fa-trash-alt", "green"],
        5 => ["Options already exists", "fas fa-exclamation-circle", "orange"],
        6 => ["Option inserted successfully", "fas fa-check-circle", "green"],
        7 => ["Option deleted successfully", "fas fa-trash-alt", "red"],
        8 => ["Option updated successfully!", "fas fa-user-check", "green"],
        9 => ["Tag is already in the database", "fas fa-tag", "orange"],
        10 => ["Product inserted successfully", "fas fa-check-circle", "green"],
        11 => ["Order approved successfully", "fas fa-check-circle", "green"],
        12 => ["User info updated successfully", "fas fa-user-edit", "green"],
        13 => ["User deleted successfully", "fas fa-user-times", "red"],
        14 => ["Product updated successfully", "fas fa-check-circle", "green"],

    ];

    // Mapping colors to alert classes
    $alertClasses = [
        'green' => 'alert-success',
        'red' => 'alert-danger',
        'orange' => 'alert-warning'
    ];

    if (isset($notifications[$_GET['notify']])) {
        list($message, $icon, $color) = $notifications[$_GET['notify']];
        $alertClass = isset($alertClasses[$color]) ? $alertClasses[$color] : 'alert-info'; // Default to info if color is not mapped
        $iconColor = $color;

        echo "<script>
        $(document).ready(function () {
            $('#notification-container .alert')
                .addClass('$alertClass show')
                .find('.notifyMsg')
                .text('$message');
            $('#notification-container .alert i')
                .addClass('$icon')
                .css('color', '$iconColor');
        });
        </script>";
    }
}
?>