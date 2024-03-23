<?php 
session_start();
if(!isset($_SESSION["loggedin"])){
	header("location:../login.php"); 
}
require_once "../config.php";
require "navbarPlant.php";
// $emailId = $_SESSION['emailId'];

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
</head>

<body>

    

    <div class="h-100 ">


        <div class="tab h-75 d-flex flex-column justify-content-center">
            <button class="tablinks d-flex justify-content-center fw-bold " onclick="openCity(event, 'Profile')">Profile</button>
            <button class="tablinks d-flex justify-content-center fw-bold " onclick="openCity(event, 'Privacy')">Privacy</button>
            <button class="tablinks d-flex justify-content-center fw-bold " onclick="openCity(event, 'Settings')">Settings</button>
            <button class="tablinks d-flex justify-content-center fw-bold " onclick="openCity(event, 'About')">About Us</button>
            <button class="tablinks d-flex justify-content-center fw-bold " onclick="openCity(event, 'Contact')">Contact</button>
        </div>

        <div id="Profile" class="tabcontent p-3 px-5">
            <h3 class="fw-5 fs-2 my-3">Profile</h3>
            <div class="p-3">
                <div class="d-flex m-3 my-4 justify-content-evenly">
                    <label for="" class="fw-bold mx-4 w-50">First Name:</label>
                    <input type="text" name="" id="" placeholder="Shrajan" class="w-50  px-2 rounded-3 border-1">
                </div>
                <div class="d-flex  m-3 my-4 justify-content-evenly">
                    <label for="" class="fw-bold mx-4 w-50">Last Name:</label>
                    <input type="text" name="" id="" placeholder="Gupta" class="w-50  px-2 rounded-3 border-1">
                </div>
                <div class="d-flex  m-3 my-4 justify-content-evenly">
                    <label for="" class="fw-bold mx-4 w-50">E-mail:</label>
                    <input type="email" name="" id="" placeholder="Shrajan@gmail.com" class="w-50  px-2 rounded-3 border-1">
                </div>
                <div class="d-flex  m-3 my-4 justify-content-evenly">
                    <label for="" class="fw-bold mx-4 w-50">Phone No.:</label>
                    <input type="number" name="" id="" placeholder="1234567890" class="w-50  px-2 rounded-3 border-1">
                </div>
                <div class="d-flex  m-3 my-4 justify-content-evenly">
                    <label for="" class="fw-bold mx-4 w-50">Alternate Phone No.:</label>
                    <input type="number" name="" id="" placeholder="9876543210" class="w-50  px-2 rounded-3 border-1">
                </div>
                <div class="d-flex  m-3 my-4 justify-content-evenly">
                    <label for="" class="fw-bold mx-4 w-50">Location:</label>
                    <input type="text" name="" id="" placeholder="Geeta Bhawan" class="w-50  px-2 rounded-3 border-1">
                </div>
            </div>
        </div>

        <div id="Privacy" class="tabcontent p-3 px-5">
            <h3 class="fw-5 fs-2 my-3 ">Privacy</h3>
            <div class="p-3">
                <h5 class="fw-5 fs-2 my-3 ">Change Password:</h5>
                <div class="d-flex m-3 my-4 justify-content-evenly">
                    <label for="" class="fw-bold mx-4 w-50">Current Password</label>
                    <input type="text" name="" id="" placeholder="********" class="w-50  px-2 rounded-3 border-1">
                </div>
                <div class="d-flex  m-3 my-4 justify-content-evenly">
                    <label for="" class="fw-bold mx-4 w-50">New Password</label>
                    <input type="text" name="" id="" placeholder="********" class="w-50  px-2 rounded-3 border-1">
                </div>
                <div class="d-flex  m-3 my-4 justify-content-evenly">
                    <label for="" class="fw-bold mx-4 w-50">Confirm New Password:</label>
                    <input type="text" name="" id="" placeholder="********" class="w-50  px-2 rounded-3 border-1">
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-success  mx-2">Save</button>
            </div>
        </div>

        <div id="Settings" class="tabcontent p-3 px-5">
            <h3 class="fw-5 fs-2 my-3 ">Settings</h3>
            <div class="w-100 mx-5 my-2 p-4 d-flex flex-column">
                <h3>Lorem.</h3>
                <div>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, veritatis hic numquam laudantium inventore saepe sint. Repudiandae magnam est aut excepturi, blanditiis, nemo officia vel aperiam cum optio, ipsam nobis saepe porro ex ad.
                </div>
            </div>
            <div class="w-100 mx-5 my-2 p-4 d-flex flex-column">
                <h3>Lorem.</h3>
                <div>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, veritatis hic numquam laudantium inventore saepe sint. Repudiandae magnam est aut excepturi, blanditiis, nemo officia vel aperiam cum optio, ipsam nobis saepe porro ex ad.
                </div>
            </div>
            <div class="w-100 mx-5 my-2 p-4 d-flex flex-column">
                <h3>Lorem.</h3>
                <div>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, veritatis hic numquam laudantium inventore saepe sint. Repudiandae magnam est aut excepturi, blanditiis, nemo officia vel aperiam cum optio, ipsam nobis saepe porro ex ad.
                </div>
            </div>
            <div class="w-100 mx-5 my-2 p-4 d-flex flex-column">
                <h3>Lorem.</h3>
                <div>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, veritatis hic numquam laudantium inventore saepe sint. Repudiandae magnam est aut excepturi, blanditiis, nemo officia vel aperiam cum optio, ipsam nobis saepe porro ex ad.
                </div>
            </div>
            <div>

            </div>
        </div>

        <div id="About" class="tabcontent p-3 px-5">
            <h3 class="fw-5 fs-2 my-3 ">About Us</h3>
            <div class="w-100 mx-5 my-2 p-4 d-flex flex-column">
                <h3>Lorem.</h3>
                <div>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, veritatis hic numquam laudantium inventore saepe sint. Repudiandae magnam est aut excepturi, blanditiis, nemo officia vel aperiam cum optio, ipsam nobis saepe porro ex ad.
                </div>
            </div>
            <div class="w-100 mx-5 my-2 p-4 d-flex flex-column">
                <h3>Lorem.</h3>
                <div>
                    Lorem ipsum dolor sit amet consectetur adipisicinglor Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas, reiciendis natus. Eum dolores, hic inventore et quae quis placeat minus iusto, consectetur harum veritatis incidunt, voluptatum suscipit. Sunt beatae exercitationem repudiandae, inventore accusamus, nostrum a in, animi asperiores ullam aspernatur!
                    Lorem ipsum dolor sit amet consectetur adipisicinglor Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas, reiciendis natus. Eum dolores, hic inventore et quae quis placeat minus iusto, consectetur harum veritatis incidunt, voluptatum suscipit. Sunt beatae exercitationem repudiandae, inventore accusamus, nostrum a in, animi asperiores ullam aspernatur!
                    Lorem ipsum dolor sit amet consectetur adipisicinglor Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas, reiciendis natus. Eum dolores, hic inventore et quae quis placeat minus iusto, consectetur harum veritatis incidunt, voluptatum suscipit. Sunt beatae exercitationem repudiandae, inventore accusamus, nostrum a in, animi asperiores ullam aspernatur!
                    Lorem ipsum dolor sit amet consectetur adipisicinglor Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas, reiciendis natus. Eum dolores, hic inventore et quae quis placeat minus iusto, consectetur harum veritatis incidunt, voluptatum suscipit. Sunt beatae exercitationem repudiandae, inventore accusamus, nostrum a in, animi asperiores ullam aspernatur!
                </div>
            </div>
        </div>

        <div id="Contact" class="tabcontent p-3 px-5">
            <h3 class="fw-5 fs-2 my-3 ">Contact us</h3>
            <div class="w-100 mx-5 my-2 p-4 d-flex flex-column">
                <h3>Lorem.</h3>
                <div>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, veritatis hic numquam laudantium inventore saepe sint. Repudiandae magnam est aut excepturi, blanditiis, nemo officia vel aperiam cum optio, ipsam nobis saepe porro ex ad.
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script>
        function openCity(evt, cityName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the link that opened the tab
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
</body>

</html>