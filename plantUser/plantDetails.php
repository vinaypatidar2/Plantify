<?php
session_start();
if (!isset($_SESSION["loggedin"])) {
    header("location:../login.php");
}
require_once "../config.php";
require "navbarPlant.php";
$emailId = $_SESSION['emailId'];
$plantId = $_GET['plantId'];

if (isset($_GET['plantId'])) {
    $plantId = $_GET['plantId'];
    if (is_numeric($plantId) && $plantId > 0) {

        $query1 = "SELECT * FROM plantDetails WHERE plantId = '$plantId' and emailId = '$emailId'";
        $result1 = mysqli_query($conn, $query1);
        $row = mysqli_fetch_assoc($result1);
        if ($row > 0) {
            // $plantName = $row['plantName'];
            // $species = $row['species'];
            // echo "<p>Name: $plantName</p>";
            // echo "<p>Species: $species</p>";
            // echo '<div class="card card2" style="width: 15rem; height: 15rem;">';
            // echo '<img src="' . $row['imagePath'] . '" class="card-img-top w-100 h-80"></div>';
        } else {
            header("location:dashboard.php");
        }
    }
    echo '<a href="dashboard.php">Back to All Plants</a>';
} else {
    header("location:dashboard.php");
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    date_default_timezone_set('Asia/Kolkata');
    $mindate = date('F d Y');
    // $mindate;

    $date = mysqli_real_escape_string($conn, $_POST['dateInput']);
    $time = mysqli_real_escape_string($conn, $_POST['timeInput']);
    $dateTimeString = $date . ' ' . $time;

    $dateTime = new DateTime($dateTimeString);
    $dateTime = $dateTime->format('Y-m-d H:i:s');

    $sql = "UPDATE plantDetails SET wateringSchedule='$dateTime' WHERE plantId='$plantId'";
    $result = mysqli_query($conn, $sql);

   
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/3df97b829c.js" crossorigin="anonymous"></script>
    <title>plantify</title>
    <link rel="stylesheet" href="css/market.css" />
</head>

<body>

    <div class="div d-flex m-3 mt-4 mb-2 justify-content-center fs-5 flex-column">
        <div class="d-flex justify-content-center">
            <p class="fw-medium fst-italic m-0 p-0">Here!</p>
        </div>
        <div class="d-flex justify-content-center">
            <p class="fw-medium fst-italic m-0 p-0">
                All the plants details you need...
            </p>
        </div>
    </div>
    <?php
    if (isset($_GET['plantId'])) {
        $plantId = $_GET['plantId'];
        if (is_numeric($plantId) && $plantId > 0) {

            $query1 = "SELECT * FROM plantDetails WHERE plantId = '$plantId' and emailId = '$emailId'";
            $result1 = mysqli_query($conn, $query1);
            $row = mysqli_fetch_assoc($result1);
            if ($row > 0) {
                $plantName = $row['plantName'];
                $species = $row['species'];
    ?>


                <div class="mx-5 p-5 d-flex flex-row cardcontainer">
                    <div class="d-flex w-100 h-100 border-2 mx-5">
                        <div class="card" style="width: 18rem">
                            <img src=" <?php echo $row['imagePath']; ?> " class="card-img-top w-100 h-100" alt="..." />
                        </div>
                    </div>

                    <div class="d-flex flex-column justify-content-start w-75 mx-5">
                        <div class="d-flex flex-row align-items-center">
                            <p class="fs-3 fw-bold">Name: &nbsp;</p>
                            <p class="fs-5"> <?php echo $plantName; ?> </p>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                            <p class="fs-3 fw-bold">Species: &nbsp;</p>
                            <p class="fs-5"><?php echo $species; ?></p>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                            <p class="fs-3 fw-bold">water schedule: &nbsp;</p>
                            <p class="fs-5"><?php echo $row['wateringSchedule']; ?></p>
                        </div>

                    </div>

                    <form method="post">
                        <div class="d-flex flex-row align-items-center">
                            <p class="fs-2 fw-bold">Reminder</p>
                        </div>
                        <div class="d-flex flex-column fw-bold">
                            <label for="dateInput">Date:</label>
                            <input type="date" id="dateInput" name="dateInput" pattern="^(?!.*T00:00).*">
                            <br>
                            <label for="timeInput">Time:</label>
                            <input type="time" id="timeInput" name="timeInput">
                            <br>
                            <button type="submit">Save</button>
                        </div>
                    </form>

                </div>

    <?php
            }
        }
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="script.js"></script>

</body>

</html>