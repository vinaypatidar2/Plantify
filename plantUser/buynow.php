<?php
session_start();
if (!isset($_SESSION["loggedin"])) {
    header("location:../login.php");
}
require_once "../config.php";
// require "navbarPlant.php";
$emailId = $_SESSION['emailId'];
$buyQuantity = 1;
if (isset($_GET['productId']))
    $productId = $_GET['productId'];

if (isset($_POST['buyQuantity'])) {
    // Update buyQuantity if a new quantity is submitted
    $buyQuantity = intval($_POST['buyQuantity']);
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
    <link rel="stylesheet" href="css/market.css"></style>
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
            Thank You for shopping with us.
        </p>
        <p class="fw-bolder fs-4 d-flex flex-wrap justify-content-center text-success">
            We will take great care of your product getting delivered as soon as possible and with proper care.
        </p>
    </div>

    <div class=" d-flex flex-column px-5 w-100">
        <div class="sh1 d-flex align-items-center justify-content-between px-3 py-1 my-4 mx-4">
                <span class="fw-bold fs-6 wid">Product</span>
                <span class="fw-bold fs-6 wid">Price</span>
                <span class="fw-bold fs-6 wid">Quantity</span>
                <span class="fw-bold fs-6 wid">Total</span>
        </div>
        <div class="sh2 d-flex align-items-center justify-content-between px-3 py-1 my-1 mx-4">

        <?php
                $sql2 = "SELECT * FROM products where productId = '$productId' ";
                // $buyQuantity = 1;
                $result2 = mysqli_query($conn, $sql2);
                if ($result2 ->num_rows > 0) {
                        $row = mysqli_fetch_assoc($result2);
                        $productName = $row['productName'];
                        $price = $row['price'];
                        // $buyQuantity = 1;
                        $totalPrice = $price * $buyQuantity;
                        echo '
                        <span class="wid">'. $productName .'</span>
                        <span class="wid">'. $price .'</span>
                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                        <form method="post" action="">
                        <input id="form1" min="1" name="buyQuantity" value="' . $buyQuantity . '" type="number" class="form-control form-control-sm w-25" />
                        <input type="submit" value="Update Quantity" />
                        </form>
                            
                        </div>
                        <span class="wid">';
                        $totalPrice = $price * $buyQuantity;
                        echo $totalPrice . '</span>
                        ';   
                }
        ?>
        </div>
    </div>

    <div class="d-flex justify-content-around px-5 w-100 my-5">
        <span class="fw-bold fs-6">Total:</span>
        <span class="fw-bold fs-6">₹<?php echo $totalPrice; ?></span>
    </div>
    
    <div class="d-flex justify-content-between px-5 w-100 my-1">
        <div class="mx-4 px-4 w-50">
            <label for="cars" class="fw-medium mx-2 px-2">Choose mode of Payment:</label>
            <select name="cars" id="cars" class=" px-2 border-1 rounded-5">
                <option value="Upi">Online Payment</option>
                <option value="Cod">Cash on Delivery</option>
            </select>
        </div>
        <a href="placeorder.php?buyQuantity=<?php echo $buyQuantity; ?>&totalPrice=<?php echo $totalPrice; ?>">
            <button type="button" class="btn btn-danger mx-4 px-4 fw-bolder">Place Order <i class="fa-solid fa-arrow-right"></i></button>
        </a>
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