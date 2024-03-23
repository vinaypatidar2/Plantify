

<?php
session_start();
if(!isset($_SESSION["loggedin"])){
	header("location:../login.php"); 
}
require_once "../config.php";
require_once "navbarSeller.php";
// require_once "navbarSeller.php";
$emailId = $_SESSION['emailId'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Seller Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3df97b829c.js" crossorigin="anonymous"></script>
</head>
<body>
    
    <h1>Manage Plant</h1>
    

    <div class="mx-5 p-5 d-flex flex-wrap cardcontainer justify-content-around">

        <?php
            $sql2 = "SELECT * FROM products where sellerId='$emailId' ";
            $result2 = mysqli_query($conn, $sql2);
            if ($result2 ->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result2)) {
                    echo '<div class="card card2 py-0" style="width: 15rem; height: 22rem;">
                        <img src="' . $row['imagePath'] . '" class="card-img-top w-100 h-75" alt="...">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <h4 class="card-title justify-content-center d-flex">' . $row['productName'] . '</h4>
                            </div>
                            <div class="card-text">Price: Rs.  ' . $row['price'] . '</div>
                            <div class="card-text">DESCRIPTION: ' . $row['description'] . '</div>
                        </div>
                    </div>';    
                }
            }

        ?>
            
        </div>
    
</body>

</html>

<!-- <body>
    
    <h2 class="mb-4 ">Your Listed Plants</h2>

    <div class="mx-5 p-5 d-flex flex-wrap cardcontainer justify-content-around">
        <div class="card card2" style="width: 15rem; height: 25rem;">
            <img src="images/plant-photo.jpg" class="card-img-top w-100 h-50" alt="...">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title justify-content-center d-flex">Aloe vera</h5>
                    <h5>₹ 150</h5>
                </div>
                <div class="d-flex justify-content-between">
                    <h5 class="card-title justify-content-center d-flex">Quantity : </h5>
                    <h5>10</h5>
                </div>
                <p class="card-text">Good for skin and medical purpose, contains vitamins, bla bla and bla bla bla.</p>
                <div class="d-flex justify-content-center align-items-center">
                    <a href="#" class="btn link-success fw-bold text-capitalize">EDIT <i class=""></i></a>
                    <a href="#" class="btn link-success fw-bold text-capitalize">DELETE <i class=""></i></a>
                </div>
            </div>
        </div>
        <div class="card card2" style="width: 15rem; height: 25rem;">
            <img src="images/plant-photo.jpg" class="card-img-top w-100 h-50" alt="...">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title justify-content-center d-flex">Aloe vera</h5>
                    <h5>₹ 150</h5>
                </div>
                <div class="d-flex justify-content-between">
                    <h5 class="card-title justify-content-center d-flex">Quantity : </h5>
                    <h5>10</h5>
                </div>
                <p class="card-text">Good for skin and medical purpose, contains vitamins, bla bla and bla bla bla.</p>
                <div class="d-flex justify-content-center align-items-center">
                    <a href="#" class="btn link-success fw-bold text-capitalize">EDIT <i class=""></i></a>
                    <a href="#" class="btn link-success fw-bold text-capitalize">DELETE <i class=""></i></a>
                </div>
            </div>
        </div>
        <div class="card card2" style="width: 15rem; height: 25rem;">
            <img src="images/plant-photo.jpg" class="card-img-top w-100 h-50" alt="...">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title justify-content-center d-flex">Aloe vera</h5>
                    <h5>₹ 150</h5>
                </div>
                <div class="d-flex justify-content-between">
                    <h5 class="card-title justify-content-center d-flex">Quantity : </h5>
                    <h5>10</h5>
                </div>
                <p class="card-text">Good for skin and medical purpose, contains vitamins, bla bla and bla bla bla.</p>
                <div class="d-flex justify-content-center align-items-center">
                    <a href="#" class="btn link-success fw-bold text-capitalize">EDIT <i class=""></i></a>
                    <a href="#" class="btn link-success fw-bold text-capitalize">DELETE <i class=""></i></a>
                </div>
            </div>
        </div>
        <div class="card card2" style="width: 15rem; height: 25rem;">
            <img src="images/plant-photo.jpg" class="card-img-top w-100 h-50" alt="...">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title justify-content-center d-flex">Aloe vera</h5>
                    <h5>₹ 150</h5>
                </div>
                <div class="d-flex justify-content-between">
                    <h5 class="card-title justify-content-center d-flex">Quantity : </h5>
                    <h5>10</h5>
                </div>
                <p class="card-text">Good for skin and medical purpose, contains vitamins, bla bla and bla bla bla.</p>
                <div class="d-flex justify-content-center align-items-center">
                    <a href="#" class="btn link-success fw-bold text-capitalize">EDIT <i class=""></i></a>
                    <a href="#" class="btn link-success fw-bold text-capitalize">DELETE <i class=""></i></a>
                </div>
            </div>
        </div>


    </div>


     Repeat this block for each listed plant -->
    <!-- </div> -->
    <!-- </section> -->

<!-- </body>  -->

<!-- </html> -->