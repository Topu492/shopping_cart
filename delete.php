<!---- delete login--->

<?php
include('connect.php');

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "Delete from `products` where id = $id") or die("Query Failed") ;

    if($delete_query){
        echo "Product deleted";
        header('location:view_products.php');
    }
    else{
        echo "Product not deleted";
        header('location:view_products.php');
    }

}
















?>