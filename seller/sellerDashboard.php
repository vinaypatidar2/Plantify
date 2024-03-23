<?php
session_start();
if (!isset($_SESSION["loggedin"])) {
    header("location:../login.php");
}
require_once "../config.php";
require "navbarSeller.php";
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
    <style>
        .UpdateStock {
            display: flex;
            /* Use flexbox to arrange items horizontally */
        }

        .card-text {
            margin-right: 10px;
            /* Add some spacing between buttons (adjust as needed) */
        }

        .update {
            border-color: gray;
            margin: 5px;
            padding: 5px;
        }

        /* CSS for the popup */
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1;
        }

        .popup-content {
            background-color: white;
            text-align: center;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }
    </style>
    <h1 class="d-flex justify-content-center my-2">Manage Plant</h1>


    <div class="mx-5 p-5 d-flex flex-wrap cardcontainer ">

        <?php
        $sql2 = "SELECT * FROM products where sellerId='$emailId' ";
        $result2 = mysqli_query($conn, $sql2);
        if ($result2->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result2)) {
                echo '<div class="card card2 py-0 mx-3 my-4" style="width: 18rem; height: 30rem;">
                        <img src="' . $row['imagePath'] . '" class="card-img-top w-100 h-75" alt="...">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <h4 class="card-title justify-content-center d-flex">' . $row['productName'] . '</h4>
                            </div>
                            <div class="card-text">Price: Rs.  ' . $row['price'] . '</div>
                            <div class="card-text">Quantity: Rs.  ' . $row['quantity'] . '</div>
                            <div class="card-text">DESCRIPTION: ' . $row['description'] . '</div>
                            <div class="UpdateStock justify-content-center">
                                <div class="card-text"><button class="update" id="editButton">Edit</button></div>
                            </div>
                        </div>';
                // echo '
                //     <div id="customPopup" class="popup">
                //         <div class="popup-content">
                //             <p>Do you really want to delete?</p>
                //                 <a href="update_product.php?productId=' . $row['productId'] . '&action=delete">
                //                 <button type="submit" name="delete" >Yes</button></a>
                //             <button id="noButton">No</button>
                //         </div>
                //     </div>';
                //changes
                echo '<div id="editPopup" class="popup">
                        <div class="popup-content">
                            <form method="post" action="update_product.php?action1=edit" enctype="multipart/form-data">
                                <label for="quantity">Quantity:</label>
                                <input type="text" id="quantity" name="quantity"><br><br>
                                <input type="hidden" name="productId" value="' . $row['productId'] . '">
                                <label for="price">Price (Rs.):</label>
                                <input type="text" id="price" name="price"><br><br>
                                <button type="submit" >Save</button>
                            </form>
                        </div>
                    </div>
                </div>';
            }
        }

        ?>

    </div>
    <script>
        // Function to show the confirmation popup
        // const deleteButton = document.getElementById("deleteButton");
        const customPopup = document.getElementById("customPopup");
        const yesButton = document.getElementById("yesButton");
        const noButton = document.getElementById("noButton");
        let productNameToDelete;

        // deleteButton.addEventListener("click", () => {
        //     productNameToDelete = deleteButton.getAttribute("data-product-name");
        //     customPopup.style.display = "block";
        // });
        const deleteButtons = document.querySelectorAll(".update");

        deleteButtons.forEach((deleteButton) => {
            deleteButton.addEventListener("click", () => {
                productNameToDelete = deleteButton.getAttribute("data-product-name");
                customPopup.style.display = "block";
            });
        });

        // yesButton.addEventListener("click", () => {
        //     if (productNameToDelete) {
        //         // Create a FormData object to send data as a POST request
        //         const formData = new FormData();
        //         formData.append("productName", productNameToDelete);

        //         // Send a POST request to your PHP script
        //         fetch(window.location.href, {
        //             method: 'POST',
        //             body: formData,
        //         })
        //     }
        // });

        noButton.addEventListener("click", () => {
            customPopup.style.display = "none";
        });

        window.addEventListener("click", (event) => {
            if (event.target === customPopup) {
                customPopup.style.display = "none";
            }
        });

        // Get all "Edit" buttons and save buttons
        // Get all "Edit" buttons and edit popups
        const editButtons = document.querySelectorAll(".update");
        const editPopups = document.querySelectorAll(".popup");
        // let productNameToEdit;
        editButtons.forEach((editButton) => {
            editButton.addEventListener("click", () => {
                // Hide all edit popups
                editPopups.forEach((popup) => {
                    popup.style.display = "none";
                });

                // Get the data-product-name attribute to identify the correct edit popup
                // productNameToEdit = editButton.getAttribute("data-product-name");
                const editPopup = document.getElementById("editPopup");
                // alert(productNameToEdit);
                // Display the corresponding edit popup
                editPopup.style.display = "block";
            });
        });
        // Get all "Save" buttons and edit forms
        const saveButtons = document.querySelectorAll(".saveButton");
        const editForms = document.querySelectorAll(".popup-content form");

        saveButtons.forEach((saveButton) => {
            saveButton.addEventListener("click", () => {
                // Get the form element containing the inputs
                // const form = editForms[index];
                const quantity = form.querySelector("#quantity").value;
                const price = form.querySelector("#price").value;

                // Create a FormData object to send the data
                const formData = new FormData();
                // formData.append("productName", productNameToEdit);
                formData.append("quantity", quantity);
                formData.append("price", price);

                // Send an AJAX request to update the database
                fetch("update_product.php", {
                    method: 'POST',
                    body: formData
                })
                // Hide the edit popup after saving changes
                // form.closest(".popup").style.display = "none";
            });
        });
    </script>
</body>

</html>