<?php
include("connection/connect.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION["user_id"];
    $restaurantId = $_POST["restaurant_id"];
    $rating = $_POST["rating"];
    $comment = $_POST["comment"];



    $insert = "INSERT INTO reviews ( user_id, restaurant_id, rating, comment) VALUES ('$userId','$restaurantId',  '$rating', '$comment')";
    if (mysqli_query($db, $insert)) {

        header("Location: restaurants.php?res_id=$restaurantId"); // Redirect back to the restaurant page
        exit();
    } else {

    }
}
?>