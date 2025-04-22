<?php
if (isset($_GET['id'])) {
    include("databaseConnection.php");
    $id = $_GET['id'];
    $sql = "DELETE FROM products_and_services WHERE product_id='$id'";
    if(mysqli_query($conn,$sql)){
        session_start();
        $_SESSION["delete"] = "Deleted Successfully!";
        header("Location:business.php");
    }else{
        die("Something went wrong");
    }
}
?>