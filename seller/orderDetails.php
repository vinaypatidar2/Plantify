<?php
session_start();
if (!isset($_SESSION["loggedin"])) {
    header("location:../login.php");
}
require_once "../config.php";
// require "navbarPlant.php";
$emailId = $_SESSION['emailId'];

if (isset($_GET['orderId'])) {
    $orderId = $_GET['orderId'];
} else {
    header("location:orderHistory.php");
}





?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3df97b829c.js" crossorigin="anonymous"></script>
    <style>
        .sh {
            border: 2px solid red;
        }

        /* 21/08/2023 */
        .sh1 {
            border: 2px solid rgb(97, 97, 97);
            border-radius: 20px;
        }

        .sh2 {
            border: 1px solid rgb(167, 167, 167);
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-info" data-bs-theme="dark">
        <div class="container-fluid d-flex justify-content-center">
            <a class="navbar-brand fw-bolder text-success mx-2" href="sellerDashboard.php"> Plantify <i class="fa-solid fa-leaf"></i></a>
        </div>
    </nav>

    <div class="d-flex justify-content-center m-5 flex-column">
        <p class="fw-bolder fs-4 d-flex flex-wrap justify-content-center m-0 text-success">
            Do you know?
        </p>
        <p class="fw-bolder fs-4 d-flex flex-wrap justify-content-center text-success">
            A plant can provide can provide fresh breathable oxygen throughout his lifetime.
        </p>
    </div>

    <div class=" d-flex flex-column px-5 w-100">
        <div class="sh1 d-flex align-items-center justify-content-between px-3 py-1 my-4 mx-4">
            <span class="fw-bold fs-6 wid">S.no.</span>
            <span class="fw-bold fs-6 wid">Product</span>
            <span class="fw-bold fs-6 wid">Price</span>
            <span class="fw-bold fs-6 wid">Quantity</span>
            <span class="fw-bold fs-6 wid">Total</span>
        </div>
        <?php


        $sqlRetrieveCart = "SELECT productName,orderItems.quantity as quantity,unitPrice 
        FROM orderItems LEFT JOIN Products ON orderItems.productId = Products.productId 
        WHERE orderId='$orderId' AND sellerId='$emailId'";

        $resultCart = mysqli_query($conn, $sqlRetrieveCart);
        echo ' ORDER DETAILS FOR ORDER ID :' . $orderId;
        if ($resultCart && $resultCart->num_rows > 0) {
            $sno = 1;
            $totalPrice = 0;
            $totalQuantity = 0;
            while ($product = mysqli_fetch_assoc($resultCart)) {
                // 

                echo '<div class="sh2 d-flex align-items-center justify-content-between px-3 py-1 my-1 mx-4">';
                echo '<span class="wid">' . $sno . '</span>';
                echo '<span class="wid">' . $product['productName'] . '</span>';
                echo '<span class="wid">₹' . $product['unitPrice'] . '</span>';
                echo '<span class="wid">x' . $product['quantity'] . '</span>';
                echo '<span class="wid">₹' . ($product['unitPrice'] * $product['quantity']) . '</span>';
                echo '</div>';
                $sno++;
                $totalPrice += ($product['unitPrice'] * $product['quantity']);
                $totalQuantity += $product['quantity'];
            }
            echo '<div class="d-flex justify-content-around px-5 w-100 my-5">';
            echo '<span class="fw-bold fs-5">Total:</span>';
            echo '<span class="fw-bold fs-5">₹' . $totalPrice . '</span>';
            echo '<span class="fw-bold fs-5">' . $totalQuantity . '</span>';
            
            echo '</div>';
        } else {
            echo "order details not found";
        }

        ?>
    </div>




    <div class="d-flex justify-content-between px-5 w-100 my-1">

        <a href="orderHistory.php">
            <button type="button" class="btn btn-danger mx-4 px-4 fw-bolder"> <i class="fa-solid fa-arrow-left"></i> Back</button>
        </a>
    </div>


</body>

</html>