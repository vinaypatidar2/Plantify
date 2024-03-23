<?php
session_start();
if (!isset($_SESSION["loggedin"])) {
    header("location:../login.php");
}
require_once "../config.php";
require "navbarPlant.php";
$emailId = $_SESSION['emailId'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $plantName = mysqli_real_escape_string($conn, $_POST['plantName']);

    $species = mysqli_real_escape_string($conn, $_POST['species']);
    // $image = mysqli_real_escape_string($conn, $_POST['image']);

    $imageName = $_FILES['image']['name'];
    $imageTempPath = $_FILES['image']['tmp_name'];
    $imageUploadPath = 'uploads/' . $imageName;
    move_uploaded_file($imageTempPath, $imageUploadPath);




    $sql1 = "INSERT INTO plantDetails(emailId,plantName,species,imagePath) VALUES('$emailId','$plantName','$species','$imageUploadPath')";
    $result1 = mysqli_query($conn, $sql1);
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3df97b829c.js" crossorigin="anonymous"></script>
    <title>plantify</title>
    <link rel="stylesheet" href="css/market.css">
</head>

<body>



    <div class="div d-flex m-3 mt-4 mb-2 justify-content-center fs-5 flex-column">
        <div class="d-flex justify-content-center">
            <p class="fw-medium fst-italic m-0 p-0">Welcome!! </p>
        </div>
        <div class="d-flex justify-content-center">
            <p class="fw-medium fst-italic m-0 p-0">We are glad to have you back.</p>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" id="plantForm">
                        <div class="mb-3">
                            <label for="plantName">Plant Name</label>
                            <input type="text" class="form-control" id="plantName" name="plantName" placeholder="Enter Plant name">
                        </div>
                        <div class="mb-3">
                            <label for="species">Species</label>
                            <input type="text" class="form-control" id="species" name="species" placeholder="Enter Plant Species">
                        </div>

                        <div class="mb-3">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
                        <div class="mb-3">
                            <label for="image">Plant Image</label>
                            <input type="file" class="form-control-file" name="image" id="image" accept="image/*">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Add plant</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>


    
    <div class="d-flex mx-5 my-4 justify-content-around px-3">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"> + Add Plant</button>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"> Notifications</button>
    </div>


    <div class="mx-5 p-5 d-flex flex-wrap cardcontainer ">
        <?php
        $sql2 = "SELECT * FROM plantDetails WHERE emailId = '$emailId'";
        $result2 = mysqli_query($conn, $sql2);
        if ($result2->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result2)) {
                echo '<div class="card card2 py-0" style="width: 18rem; height: 23rem;">
                        <img src="' . $row['imagePath'] . '" class="card-img-top w-100 h-75" alt="...">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <h4 class="card-title justify-content-center d-flex">' . $row['plantName'] . '</h4>
                            </div>
                            <a href="plantDetails.php?plantId=' . $row['plantId'] . '">View More</a>
                        </div>
                    </div>';
            }
        }

        ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="script.js"></script>


</body>

</html>