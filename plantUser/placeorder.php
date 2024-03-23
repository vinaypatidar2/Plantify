<?php
session_start();
if (!isset($_SESSION["loggedin"])) {
    header("location:../login.php");
}
require_once "../config.php";
// require "navbarPlant.php";
$emailId = $_SESSION['emailId'];
$buyQuantity = 0;
$totalPrice = 0;
$orderId = 0;
if (isset($_GET['buyQuantity']) and isset($_GET['totalPrice'])) {
    $buyQuantity = $_GET['buyQuantity'];
    $totalPrice = $_GET['totalPrice'];

    $sql1 = "INSERT INTO orders(buyerId,orderDate,totalAmount) 
            VALUES('$emailId',current_timestamp,'$totalPrice')";
    $result1 = mysqli_query($conn, $sql1);

    $orderId = mysqli_insert_id($conn);



    $sql2 = "INSERT INTO orderItems(orderId,productId,quantity,unitPrice)
            SELECT  $orderId,c.productId,c.quantity,p.price FROM cart c left join products p 
            ON c.productId = p.productId WHERE c.emailId = '$emailId'";
    $result2 = mysqli_query($conn, $sql2);

    $sql3 = "DELETE FROM cart WHERE emailId = '$emailId'";
    $result3 = mysqli_query($conn, $sql3);
    if (!($result1 && $result2 && $result3)) {
        echo "<h2>ORDER PLACED</h2>";
        echo 'Error changing data: ' . mysqli_error($conn);
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
    <!-- navigation bar  -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-info" data-bs-theme="dark">
        <div class="container-fluid d-flex justify-content-center">
            <a class="navbar-brand fw-bolder text-success mx-2" href="market.php"> Plantify <i class="fa-solid fa-leaf"></i></a>
        </div>
    </nav>

    <div class="d-flex justify-content-center m-5 flex-column">
        <p class="fw-bolder fs-4 d-flex flex-wrap justify-content-center m-0 text-success">
            Your Product will be delivered in next 5 days.
        </p>
        <p class="fw-bolder fs-4 d-flex flex-wrap justify-content-center text-success">
            If any query, contact at : +91 1234567890 or shrajan@email.com
        </p>
    </div>

    <div class="d-flex w-100 justify-content-center w-100">
        <div class="d-flex flex-column w-50">
            <div class="d-flex m-2 justify-content-between">
                <span class="fw-medium">Order ID:</span>
                <span class="fw-medium"><?php echo $orderId; ?></span>
            </div>
            <div class="d-flex m-2 justify-content-between">
                <span class="fw-medium">Date of Order:</span>
                <span class="fw-medium"> 21-09-2023</span>
            </div>
            <div class="d-flex m-2 justify-content-between">
                <span class="fw-medium">Name:</span>
                <span class="fw-medium">Shrajan Gupta</span>
            </div>
            <div class="d-flex m-2 justify-content-between">
                <span class="fw-medium">Contact:</span>
                <span class="fw-medium">+91 1234567890</span>
            </div>

            <div class="d-flex m-2 justify-content-between">
                <span class="fw-medium">Quantity:</span>
                <span class="fw-medium"><?php echo $buyQuantity; ?></span>
            </div>
            <div class="d-flex m-2 justify-content-between">
                <span class="fw-medium">Total Amount:</span>
                <span class="fw-medium">₹<?php echo $totalPrice; ?></span>
            </div>

            <div class="d-flex justify-content-center mt-5">
                <a href="market.php">
                    <button type="button" class="btn btn-danger">Home Page</button>
                </a>
            </div>
        </div>
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