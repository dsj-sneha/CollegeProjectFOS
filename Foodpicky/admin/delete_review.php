<?php
include("../connection/connect.php");
error_reporting(0);
session_start();


// sending query
mysqli_query($db, "DELETE FROM reviews WHERE review_id = '" . $_GET['review_del'] . "'");
header("location:review_table.php");

?>