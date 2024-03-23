<?php
session_start();
if (!isset($_SESSION["loggedin"])) {
    header("location:../login.php");
}
require_once "../config.php";
require "navbarSeller.php";
$emailId = $_SESSION['emailId'];

// echo " " . $_SESSION['loggedin'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Assistant</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3df97b829c.js" crossorigin="anonymous"></script>
</head>
<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;

    }

    body {
        width: 100vw;
        height: 100%;
        /* background-image: linear-gradient(to right, #8360c3, #2ebf91); */

    }

    .feedopt {
        height: 20%;
    }

    .card {
        width: 40%;
    }

    .filterbtn {
        width: 5%;
    }

    .searchbox {
        width: 255px;
    }

    .dabba {
        border: 2px solid red;
    }

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

    /* setting part  */

    .tab {
        float: left;
        /* border: 1px solid #ccc; */
        /* background-color: #228823; */
        width: 10%;
        /* height: 300px; */
        height: 100vh;
    }

    /* Style the buttons that are used to open the tab content */
    .tab button {
        display: block;
        background-color: inherit;
        color: black;
        padding: 22px 16px;
        width: 100%;
        border: none;
        outline: none;
        text-align: left;
        cursor: pointer;
        transition: 0.3s;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        /* background-color: #ddd; */
        color: rgb(2, 237, 2);
    }

    /* Create an active/current "tab button" class */
    .tab button.active {
        background-color: #ccc;
        color: rgb(160, 65, 73);
        font-size: 25px;
    }

    /* Style the tab content */
    .tabcontent {
        float: left;
        padding: 0px 12px;
        border: 1px solid #ccc;
        width: 80%;
        border: none;
        border-left: none;
        /* height: 300px; */
        height: 100vh;
        display: none;
    }

    .cardcontainer {
        border: 2px solid rgb(45, 131, 64);
        border-radius: 16px;

    }

    .card2 {
        margin: 10px 15px;
    }
</style>

<body>



    <div class="container p-5 d-flex flex-column">
        <div>
            <p class="fs-3 fw-bolder p-2"> Your Recent orders:</p>
        </div>
        <div class=" d-flex flex-column py-3">
            <div class="sh1 d-flex align-items-center justify-content-between px-5 py-1 my-4">
                <span class="fw-bolder fs-3">S.no.</span>
                <span class="fw-bolder fs-3">Order ID</span>
                <span class="fw-bolder fs-3">Date</span>
                <span class="fw-bolder fs-3">Status</span>
            </div>

            <?php
            $sql1 = "SELECT * FROM orders WHERE orderId IN (SELECT orderId from orderItems where productId in (
                SELECT productId from products where sellerId = '$emailId' ))";
            $result1 = mysqli_query($conn, $sql1);
            if ($result1->num_rows > 0) {
                $sno = 1;
                while ($row = mysqli_fetch_assoc($result1)) {
                    echo '<a style="text-decoration:none; color:black" href = orderDetails.php?orderId=' . $row['orderId'] . ' >  
                <div class="sh2 d-flex align-items-center justify-content-between px-5 py-1 my-1 mx-3">
                <span>' . $sno . '</span>
                <span>' . $row['orderId'] . '</span>
                <span>' . $row['orderDate'] . '</span>
                <span>Completed</span>
                </div></a>
                ';
                    $sno++;
                }
            } else {
                echo "NO ORDERS FOUND";
            }

            ?>




        </div>
    </div>


</body>

</html>