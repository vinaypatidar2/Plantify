<?php 
session_start();
if(!isset($_SESSION["loggedin"])){
	header("location:../login.php"); 
}
require_once "../config.php";
require "navbarPlant.php";
// $conn = mysqli_connect("localhost", "root", "", "plantify");
// $emailId = $_SESSION['emailId'];
if(isset($_POST["name"])){
    $name = $_POST["name"];
    $comment = $_POST["comment"];
    $date = date('F d Y, h:i:s A');
    // $reply_id = $_POST["reply_id"];
    $reply_id = 0;
  
    $query = "INSERT INTO tb_data(name,comment,date,reply_id) VALUES( '$name', '$comment', '$date', '$reply_id')";
    $result = mysqli_query($conn, $query);
    if (!$result){
        echo "false";
    }else{
        echo "true";
    }
}
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
<body>
    

        <div class="feed w-100 h-100 d-flex flex-column">

            <div class="feedopt d-flex justify-content-center align-items-center flex-column w-100">
                <span class="text-info-emphasis fw-medium">Select View</span>
                <div class="btn-group">
                    <a href="feeds_my.php" class="btn btn-primary active fw-bolder" aria-current="page">Create Posts</a>
                    <a href="feed_all.php" class="btn btn-primary">All Posts</a>
                  </div>
            </div>

            <div class="feeds d-flex w-100 my-2 justify-content-center flex-wrap">
                <form action = "" method = "post" class=" m-1 my-5 d-flex flex-column w-50" >
                    <h5 class="card-header mb-3">Create Post</h5>
                    <input type="hidden" name="reply_id" id="reply_id">
                    <input type="text" required name="name" placeholder="Your name" class="form-control my-3 border-3">
                    <textarea name="comment" required placeholder="Your comment" class="form-control my-3 border-3"></textarea>
                    <button class = "btn btn-success w-25" type="submit" name="submit">Submit</button>
                </form>
            </div>

        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script>
        function showAlert() {
            event.preventDefault();
            alert("Post successfully Posted!");
            // window.location.href = "feed_all.php";
        }
        
    </script>
</body>
</html>