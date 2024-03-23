<?php
session_start();
if (!isset($_SESSION["loggedin"])) {
    header("location:../login.php");
}
require_once "../config.php";
require "navbarPlant.php";
$emailId = $_SESSION['emailId'];




if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $quantity = 1;

    // $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    $sqlCheckCart = "SELECT productId FROM cart WHERE emailId = '$emailId' AND productId='$productId'";
    $result = mysqli_query($conn, $sqlCheckCart);

    if ($result->num_rows > 0) {
        $sqlRemoveCart = "DELETE FROM cart WHERE emailId = '$emailId' AND productId='$productId'";
        mysqli_query($conn, $sqlRemoveCart);
        header("location:market.php");
        // echo "<script> window.location.href='market.php';</script>";

    } else {
        $sqlInsertCart = "INSERT INTO cart (emailId, productId, quantity) VALUES ('$emailId', '$productId', '$quantity')";

        if (mysqli_query($conn, $sqlInsertCart)) {
            header("location:market.php");
            // echo "<script>window.location.href='market.php';</script>";
        } else {
            echo 'Error inserting into cart: ' . mysqli_error($conn);
        }
    }
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
    <link rel="stylesheet" href="css/market.css">
    </style>
</head>

<body>


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
            <span class="fw-bold fs-6 wid">Edit</span>
        </div>
        <?php

        // $sqlRetrieveCart = "SELECT * FROM cart WHERE emailId = '$emailId'";
        $sqlRetrieveCart = "SELECT productName,Cart.quantity as quantity,price FROM Cart LEFT JOIN Products ON Cart.productId = Products.productId WHERE emailId='$emailId'";

        $resultCart = mysqli_query($conn, $sqlRetrieveCart);

        if ($resultCart && $resultCart->num_rows > 0) {
            $sno = 1;
            $totalPrice = 0;
            $totalQuantity = 0;
            while ($product = mysqli_fetch_assoc($resultCart)) {
                // 

                echo '<div class="sh2 d-flex align-items-center justify-content-between px-3 py-1 my-1 mx-4">';
                echo '<span class="wid">' . $sno . '</span>';
                echo '<span class="wid">' . $product['productName'] . '</span>';
                echo '<span class="wid">₹' . $product['price'] . '</span>';
                echo '<span class="wid">x' . $product['quantity'] . '</span>';
                echo '<span class="wid">₹' . ($product['price'] * $product['quantity']) . '</span>';
                echo '<span class="wid">+ / -</span>';
                echo '</div>';
                $sno++;
                $totalPrice += ($product['price'] * $product['quantity']);
                $totalQuantity += $product['quantity'];
            }
            echo '<div class="d-flex justify-content-around px-5 w-100 my-5">';
            echo '<span class="fw-bold "></span>';
            echo '<span class="fw-bold "></span>';
            echo '<span class="fw-bold fs-5">Total:</span>';
            echo '<span class="fw-bold fs-5">' . $totalQuantity . '</span>';
            echo '<span class="fw-bold fs-5">₹' . $totalPrice . '</span>';
            echo '<span class="fw-bold"></span>';

            echo '</div>';
        } else {
            echo "CART IS EMPTY";
        }
        ?>
    </div>




    <div class="d-flex justify-content-between px-5 w-100 my-1">
        <div class="mx-4 px-4 w-50">
            <label for="cars" class="fw-medium mx-2 px-2">Choose mode of Payment:</label>
            <select name="cars" id="cars" class=" px-2 border-1 rounded-5">
                <option value="Upi">Online Payment</option>
                <option value="Cod">Cash on Delivery</option>
            </select>
        </div>
        <?php
        if (isset($totalQuantity) && $totalQuantity > 0) {
            echo '<a href="placeorder.php?buyQuantity=' . $totalQuantity . '&totalPrice=' . $totalPrice . '">
            <button type="button" class="btn btn-danger mx-4 px-4 fw-bolder">Place Order <i class="fa-solid fa-arrow-right"></i></button>
        </a>';
        } else {
            echo '<button type="button" class="btn btn-danger mx-4 px-4 fw-bolder">Place Order <i class="fa-solid fa-arrow-right"></i></button>';
        }
        ?>
        <!-- <a href="placeorder.php?buyQuantity=<?php echo $totalQuantity; ?>&totalPrice=<?php echo $totalPrice; ?>">
            <button type="button" class="btn btn-danger mx-4 px-4 fw-bolder">Place Order <i class="fa-solid fa-arrow-right"></i></button>
        </a> -->
    </div>



    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script>
        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script> -->

</body>

</html>