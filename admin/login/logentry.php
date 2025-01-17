<?php
include '../database/connect.php';
if(isset($_POST['sign_in'])){
    $username = $_POST['userName'];
    $password = $_POST['userPassword'];
    $sql="select * from admin where
    ausername='$username' and apassword='$password'";
    $result=$conn->query($sql);
    session_start();
    if($result->num_rows>0){
        $_SESSION['admin']=$username;
        echo"
        <script>
        // alert('Login Successfull');
        window.location.href='../index.php';     
        </script>
        ";    
    }
    else{
        echo"<script>
        alert('Invalid Username or Password');
        window.location.href='login.php';
        </script>";
    }
    








}
?>