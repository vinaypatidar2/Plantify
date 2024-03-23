<?php
session_start();
if (!isset($_SESSION["loggedin"])) {
    header("location:../login.php");
}
require_once "../config.php";
require "navbarSeller.php";
$emailId = $_SESSION['emailId'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $productName = mysqli_real_escape_string($conn, $_POST['productName']);
    $productPrice = mysqli_real_escape_string($conn, $_POST['productPrice']);
    $productDescription = mysqli_real_escape_string($conn, $_POST['productDescription']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    // $image = mysqli_real_escape_string($conn, $_POST['image']);

    // echo "jhgvmhg ".$plantName;
    $imageName = $_FILES['productImage']['name'];
    $imageTempPath = $_FILES['productImage']['tmp_name'];
    $imageUploadPath = 'uploads/' . $imageName;
    move_uploaded_file($imageTempPath, $imageUploadPath);




    $sql1 = "INSERT INTO PRODUCTS(productName,sellerId,price,quantity,description,imagePath,category) VALUES('$productName','$emailId','$productPrice','$quantity','$productDescription','$imageUploadPath','$category')";
    $result1 = mysqli_query($conn, $sql1);
    echo "<script>alert('Plant Added successfully'); </script>";
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Seller Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3df97b829c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/seller.css">
</head>

<body>
    <main class="p-5 m-2">

        <section class="listing-form">
            <div class="d-flex justify-content-center align-items-center mb-4 mt-2">
                <h2 class="fs-1">Add New PRODUCT </h2>
            </div>
            <form method="post" id="add-listing-form" enctype="multipart/form-data">
                <div class="mb-3 d-flex justify-content-between">
                    <label for="productName" class="form-label w-25 fw-bolder fs-4">Product Name:</label>
                    <input type="text" id="productName" name="productName" class="form-control w-75" required>
                </div>

                <div class="mb-3 d-flex justify-content-between">
                    <label for="productDescription" class="form-label w-25 fw-bolder fs-4">Description:</label>
                    <textarea id="productDescription" name="productDescription" class="form-control w-75" rows="1" required></textarea>
                </div>

                <div class="mb-3 d-flex justify-content-between">
                    <label for="productPrice" class="form-label w-25 fw-bolder fs-4">Price:</label>
                    <input type="number" id="productPrice" name="productPrice" class="form-control w-75" step="0.01" min="0" required>
                </div>
                <div class="mb-3 d-flex justify-content-between">
                    <label for="quantity" class="form-label w-25 fw-bolder fs-4">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" class="form-control w-75" step="0.01" min="0" required>
                </div>

                <div class="mb-3 d-flex justify-content-between">
                    <label for="productImage" class="form-label w-25 fw-bolder fs-4">Images:</label>
                    <input type="file" id="productImage" name="productImage" class="form-control w-75" accept="image/*" multiple required>
                </div>


                <div class="mb-3 d-flex">
                    <label class="form-label w-25 fw-bolder fs-4" for="category">Category:</label>
                    <select class="custom-select mr-sm-2" id="category" name="category" required>
                        <option selected disabled hidden>select</option>
                        <option value="Plants">Plants</option>
                        <option value="Fertilizers">Fertilizers</option>
                        <option value="Tools">Tools</option>

                    </select>
                </div>

                <div class="my-3 d-flex justify-content-center align-items-center w-100 h-100">
                    <button type="submit" class="btn btn-primary" id="submitForm">ADD</button>

                </div>
            </form>





        </section>
    </main>
</body>

</html>