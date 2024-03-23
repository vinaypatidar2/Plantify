
<?php
session_start();
if (!isset($_SESSION["loggedin"])) {
    header("location:../login.php");
}
require_once "../config.php";
require "navbarSeller.php";
$emailId = $_SESSION['emailId'];
$action = $_GET['action1'];
$productId = 0;

if ($action == "edit" && isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    echo $productId ."   ";
    echo $quantity ."  ";
    echo $price;
    // $query1 = "SELECT * FROM plantDetails WHERE plantId = '$plantId' and emailId = '$emailId'";
    $query1 = "UPDATE products SET quantity=$quantity WHERE productId=$productId";
    $query2 = "UPDATE products SET price=$price WHERE productId=$productId";
    $result1 = mysqli_query($conn, $query1);
    $result2 = mysqli_query($conn, $query2);
    echo $query1;
    if (!$result1){
        echo "not updated";
    }
    // header("location:sellerDashboard.php");
}
// header("location:sellerDashboard.php");

?>


