<?php
session_start();
if (!isset($_SESSION["loggedin"])) {
    header("location:../login.php");
}
require_once "../config.php";
require "navbarPlant.php";
$emailId =$_SESSION['emailId'];

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <!-- navigation bar  -->


    <!-- category and filter  -->
    <div class="m-3 px-5 py-4 d-flex flex-column">
        <div class="d-flex flex-row justify-content-end mb-4 w-100">
            <form class="d-flex w-75">
                <input class="form-control me-2 w-75" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success " type="submit">Search</button>
            </form>
        </div>
        <div class="d-flex flex-row justify-content-around">
            <div class="w-25 d-flex justify-content-between align-items-center">
                <a href="cart.php" class="btn link-success fw-bold text-capitalize btn-outline-success">My Cart <i class="fa-solid fa-cart-shopping"></i></a>

            </div>
            <div class="w-50 d-flex justify-content-center align-items-center">
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                    <label class="btn btn-outline-success px-3 tablinks " for="btnradio1" onclick="openCity(event, 'Plants')">Plants</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                    <label class="btn btn-outline-success px-3 tablinks" for="btnradio2" onclick="openCity(event, 'Fertilizers')">Fertilizers</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                    <label class="btn btn-outline-success px-3 tablinks " for="btnradio3" onclick="openCity(event, 'Tools')">Tools</label>
                    <!-- <button class="tablinks" onclick="openCity(event, 'London')">London</button> -->
                </div>
            </div>

            <div class="w-25 d-flex ">
                <div class="d-flex mx-1 justify-content-center align-items-center">
                    <div class="btn-group-vertical filterbtn" role="group" aria-label="Vertical button group">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Sort By:-
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Low-to-high</a></li>
                                <li><a class="dropdown-item" href="#">High-to-Low</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="d-flex mx-1 justify-content-center align-items-center">
                    <div class="btn-group-vertical filterbtn" role="group" aria-label="Vertical button group">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Filter By:
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Popularity</a></li>
                                <li><a class="dropdown-item" href="#">Relevance</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- purchase options  -->
    <div class=" mx-5 px-5 py-3 cardcontainer">

        <div id="Plants" class=" dp tabcontent">
            <div class="d-flex flex-wrap justify-content-around p-3">
                <?php
                $sql2 = "SELECT * FROM products where category='Plants' ";
                $result2 = mysqli_query($conn, $sql2);
                if ($result2->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result2)) {
                ?>
                        <div class="card card2" style="width: 15rem; height: 25rem;">
                            <img src="../seller/<?php echo $row['imagePath']; ?>" class="card-img-top w-100 h-75" alt="...">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title justify-content-center d-flex"><?php echo $row['productName']; ?></h5>
                                    <h5 class="card-title justify-content-center d-flex"><?php echo $row['price']; ?></h5>
                                </div>
                                <p class="card-text"><?php echo $row['description']; ?></p>
                                <div class="d-flex justify-content-center align-items-center">
                                    <form action="cart.php" method="post">
                                        <input type="hidden" name="productId" value="<?php echo $row['productId']; ?>">
                                        <input type="hidden" name="productName" value="<?php echo $row['productName']; ?>">
                                        <input type="hidden" name="productPrice" value="<?php echo $row['price']; ?>">
                                        <button class="btn link-success fw-bold text-capitalize" type="submit">Add to <i class="fa-solid fa-cart-plus"></i></button>
                                    </form>
                                    <a href="buynow.php?productId=<?php echo $row['productId']; ?>" class="btn link-success fw-bold text-capitalize">Buy Now <i class="fa-solid fa-truck"></i></a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <div id="Fertilizers" class=" dp tabcontent">
            <div class="d-flex flex-wrap justify-content-around p-3">
                <?php
                $sql2 = "SELECT * FROM products where category='Fertilizers' ";
                $result2 = mysqli_query($conn, $sql2);
                if ($result2->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result2)) {
                ?>
                        <div class="card card2" style="width: 15rem; height: 25rem;">
                            <img src="../seller/<?php echo $row['imagePath']; ?>" class="card-img-top w-100 h-75" alt="...">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title justify-content-center d-flex"><?php echo $row['productName']; ?></h5>
                                    <h5 class="card-title justify-content-center d-flex"><?php echo $row['price']; ?></h5>
                                </div>
                                <p class="card-text"><?php echo $row['description']; ?></p>
                                <div class="d-flex justify-content-center align-items-center">
                                    <form action="cart.php" method="post">
                                        <input type="hidden" name="productId" value="<?php echo $row['productId']; ?>">
                                        <input type="hidden" name="productName" value="<?php echo $row['productName']; ?>">
                                        <input type="hidden" name="productPrice" value="<?php echo $row['price']; ?>">
                                        <button class="btn link-success fw-bold text-capitalize" type="submit">Add to <i class="fa-solid fa-cart-plus"></i></button>
                                    </form>
                                    <a href="buynow.php?productId= <?php echo $row['productId']; ?>" class="btn link-success fw-bold text-capitalize">Buy Now <i class="fa-solid fa-truck"></i></a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <div id="Tools" class=" dp tabcontent">
            <div class="d-flex flex-wrap justify-content-around p-3">
                <?php
                $sql2 = "SELECT * FROM products where category='Tools' ";
                $result2 = mysqli_query($conn, $sql2);
                if ($result2->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result2)) {
                ?>
                        <div class="card card2" style="width: 15rem; height: 25rem;">
                            <img src="../seller/<?php echo $row['imagePath']; ?>" class="card-img-top w-100 h-75" alt="...">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title justify-content-center d-flex"><?php echo $row['productName']; ?></h5>
                                    <h5 class="card-title justify-content-center d-flex"><?php echo $row['price']; ?></h5>
                                </div>
                                <p class="card-text"><?php echo $row['description']; ?></p>
                                <div class="d-flex justify-content-center align-items-center">
                                    <form action="cart.php" method="post">
                                        <input type="hidden" name="productId" value="<?php echo $row['productId']; ?>">
                                        <input type="hidden" name="productName" value="<?php echo $row['productName']; ?>">
                                        <input type="hidden" name="productPrice" value="<?php echo $row['price']; ?>">
                                        <button class="btn link-success fw-bold text-capitalize" type="submit">Add to <i class="fa-solid fa-cart-plus"></i></button>
                                    </form>
                                    <a href="buynow.php?productId=<?php echo $row['productId']; ?>" class="btn link-success fw-bold text-capitalize">Buy Now <i class="fa-solid fa-truck"></i></a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>

        
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
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

        function addToCart(productId) {

            $.ajax({
                type: "POST",
                url: "cart.php",
                data: {
                    product_id: productId
                },
                // success: function(response) {

                //     alert("Product added to cart!");
                // }
            });
        }
    </script>
</body>

</html>