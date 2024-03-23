<?php

require_once "navbarHome.php";
// session_start();
// $_SESSION['first_Name']= $first_Name;
// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
// header("location: login.php");
//  exit; // Ensure no further code execution if the user is not logged in.
// }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plant Assistant</title>
  <!-- <link rel="stylesheet" href="home.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link href="css/index.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/3df97b829c.js" crossorigin="anonymous"></script>
</head>


<body>





  <div class="container">
    <div class="tab-content defaultOpen" id="Sales">
      <div class="container mt-4">
        <h1 class="services-main">New To Plantation?</h1>
        <!--created container using bootstrap-->
        <p class="services-heading">
          Start with some basic plants..
        </p>
      </div>
      <div class="services">
        <div class="row">
          <!--Created a grid system of 4 * 4 * 4 using bootstrap-->
          <div class="col-sm-4">
            <div class="card" id="myCard">
              <!--Created card using bootstrap for each service-->

              <div class="card-body">
                <img src="images/lavender.jpg" class="logo" />
                <h4 class="card-title">Lavender</h4>
                <p class="card-text">
                  Lavender is a fragrant herb known for its beautiful purple flowers and soothing aroma.
                </p>
                <a href="#" id="addNow">ADD <span class="arrow">&gt;</span></a>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card" id="myCard">

              <div class="card-body">
                <img src="images/alovera.jpg" class="logo" class="logo" />
                <h4 class="card-title">Aloe Vera</h4>
                <p class="card-text">
                  Aloe Vera is a succulent plant known for its soothing gel, which is used for various skin ailments
                </p>
                <a href="#" id="addNow">ADD <span class="arrow">&gt;</span></a>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card" id="myCard">

              <div class="card-body">
                <img src="images/jasmine.jpg" class="logo" class=" logo" />
                <h4 class="card-title">Jasmine</h4>
                <p class="card-text">
                  Jasmine is a fragrant flowering plant widely used in India for making garlands and perfumes
                </p>
                <a href="#" id="addNow">ADD <span class="arrow">&gt;</span></a>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card" id="myCard">

              <div class="card-body">
                <img src="images/banana.jpg" class="logo" class=" logo" />
                <h5 class="card-title">Banana</h5>
                <p class="card-text">
                  Bananas are a staple in Indian diets. Banana plants thrive in warm, humid climates with well-drained soil.
                </p>
                <a href="#" id="addNow">ADD <span class="arrow">&gt;</span></a>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card" id="myCard">

              <div class="card-body">
                <img src="images/mango.jpg" class="logo" class=" logo" />
                <h5 class="card-title">Mango</h5>
                <p class="card-text">
                  The mango tree is the national fruit of India and is known for its sweet and juicy mangoes. Mango trees thrive in tropical climates and require full sun.
                </p>
                <a href="#" id="addNow">ADD <span class="arrow">&gt;</span></a>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card" id="myCard">

              <div class="card-body">
                <img src="images/tomato.jpg" class="logo" />
                <h5 class="card-title">Tomato</h5>
                <p class="card-text">If you have space for a garden, tomatoes are a rewarding choice. They need full sun, well-draining soil, and consistent watering. You can enjoy the satisfaction of harvesting your own fresh tomatoes.</p>
                <a href="#" id="addNow">ADD <span class="arrow">&gt;</span></a>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card" id="myCard">

              <div class="card-body">
                <img src="https://watchandlearn.scholastic.com/content/dam/classroom-magazines/watchandlearn/videos/animals-and-plants/plants/what-are-plants-/What-Are-Plants.jpg" class="logo" class=" logo" />
                <h5 class="card-title">Plant 7</h5>
                <p class="card-text">
                  Comprehensive sales map visualization and optimal route
                  planning solution.
                </p>
                <a href="#" id="addNow">ADD <span class="arrow">&gt;</span></a>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card" id="myCard">

              <div class="card-body">
                <img src="https://watchandlearn.scholastic.com/content/dam/classroom-magazines/watchandlearn/videos/animals-and-plants/plants/what-are-plants-/What-Are-Plants.jpg" class="logo" class=" logo" />
                <h5 class="card-title">Plant 8</h5>
                <p class="card-text">
                  A complete loyalty and affiliate management platform.
                </p>
                <a href="#" id="addNow">ADD <span class="arrow">&gt;</span></a>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card" id="myCard">

              <div class="card-body">
                <img src="https://watchandlearn.scholastic.com/content/dam/classroom-magazines/watchandlearn/videos/animals-and-plants/plants/what-are-plants-/What-Are-Plants.jpg" class="logo" class=" logo" />
                <h5 class="card-title">Plant 9</h5>
                <p class="card-text">
                  Cloud-based telephony software for businesses.
                </p>
                <a href="#" id="addNow">ADD <span class="arrow">&gt;</span></a>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card" id="myCard">
              <div class="container" id="newtag">
                <span class="badge bg-success">Plant 10</span>
              </div>
              <div class="card-body">
                <img src="https://watchandlearn.scholastic.com/content/dam/classroom-magazines/watchandlearn/videos/animals-and-plants/plants/what-are-plants-/What-Are-Plants.jpg" class="logo" class=" logo" />
                <h5 class="card-title">Social</h5>
                <p class="card-text">
                  The all-in-one social media management software.
                </p>
                <a href="#" id="addNow">ADD <span class="arrow">&gt;</span></a>
              </div>
            </div>
          </div>
        </div>





        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <script src="script.js"></script>
</body>

</html>