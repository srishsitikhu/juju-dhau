<?php
$id=$_GET['Id'];
include'../database/connect.php';
$sql="Delete from products where product_id=$id";
$result=$conn->query($sql);
if($result){
    echo"
        <script>
         window.location.href='product.php?notify=4'; 
        </script>


    ";
}
echo $id;
?>