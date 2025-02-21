<?php
$id=$_GET['Id'];
include'../database/connect.php';
$sql="Delete from products where product_id=$id";
$result=$conn->query($sql);
if($result){
    echo"
        <script>
        alert ('record deleted succesfully');
         window.location.href='product.php'; 
        </script>


    ";
}
echo $id;
?>