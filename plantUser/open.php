<?php 
session_start();
if(!isset($_SESSION["loggedin"])){
	header("location:../login.php"); 
}
require_once "../config.php";
require "navbarPlant.php";
// $emailId = $_SESSION['emailId'];
if (isset($_GET['id']))
    $id = $_GET['id'];

// if(isset($_POST["submit"])){
//     $name = $_POST["name"];
//     $comment = $_POST["comment"];
//     $date = date('F d Y, h:i:s A');
//     // $reply_id = $_POST["reply_id"];
    
//     $query = "INSERT INTO tb_data VALUES('', '$name', '$comment', '$date', '$id')";
//     mysqli_query($conn, $query);
// }   
if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $comment = $_POST["comment"];
    $date = date('F d Y, h:i:s A');
    $reply_id = $_POST["reply_id"];
  
    $query = "INSERT INTO tb_data (id, name, comment, date, reply_id) VALUES ('', '$name', '$comment', '$date', '$reply_id')";
    
    if (mysqli_query($conn, $query)) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} 
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
<body>
    

        <div class="feed w-100 h-100 d-flex flex-column">

            

            <div class="feeds d-flex w-100 my-2 justify-content-center flex-wrap">
            
            <?php 
                 $sql4 = "SELECT * FROM tb_data WHERE id = '$id' ";
                 $result4 = mysqli_query($conn, $sql4);
                 if ($result4 ->num_rows > 0) {
                    $row = mysqli_fetch_assoc($result4);
                    $topic = $row['comment'];
                    $by = $row['name'];
                    $at = $row['date'];
                    echo '
                    <div class="card w-100 mx-5 my-4">
                        <div class="card-header fw-bolder fs-3">
                            Topic :
                        </div>
                        <div class="card-body">
                            <p class="card-text m-0 my-2">By '.$by.' at '.$at.'</p>
                            <h5 class="card-title fs-3">'.$topic.'</h5>
                        </div>
                    </div>';
                 }
            ?>

                <div class="feeds d-flex w-100 my-0 justify-content-center flex-wrap border-2">
                    <form action = "#" method = "post" class=" m-1 my-5 d-flex flex-column w-50">
                        <h5 class="card-header mb-3">Reply to this Post</h5>
                        <input type="hidden" name="reply_id" id="reply_id">
                        <input type="text" required name="name" placeholder="Your name" class="form-control my-1 border-3">
                        <textarea name="comment" required placeholder="Your comment" class="form-control my-1 border-3"></textarea>
                        <button class = "btn btn-success w-25" type="submit" name="submit">Submit</button>
                    </form>
                </div>


            <?php
                $sql5 = "SELECT * FROM tb_data WHERE reply_id = $id";
                $result5 = mysqli_query($conn, $sql5);
                if ($result5 ->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result5)) 
                    {
                        $username = $row['name'];
                        $userdate = $row['date'];
                        $usercomment = $row['comment'];
                        echo '
                        <div class="card w-75 mx-5 my-4 d-flex flex-column justify-content-center">
                            <div class="card-body w-75">
                                <h5 class="card-title ">By '.$username.' at '.$userdate.'</h5>
                                <p class="card-text m-0 my-2 fs-3">'.$usercomment.'</p>
                            </div>
                        </div>';
                    
                    }
                }
            ?>



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