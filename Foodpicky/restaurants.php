<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Restaurants</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Add this CSS to your existing styles -->
    <style>
        /* Style the modal background overlay */
        .modal-backdrop {
            opacity: 0.5;
            background-color: #000;
        }

        /* Style the modal content */
        .modal-content {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        /* Style the modal header */
        .modal-header {
            background-color: #f5f5f5;
            border-bottom: 1px solid #d1d1d1;
            padding: 15px;
        }

        /* Style the modal title */
        .modal-title {
            font-weight: bold;
            font-size: 1.25rem;
        }

        /* Style the close button */
        .close {
            font-size: 1.5rem;
        }

        /* Style the modal body */
        .modal-body {
            padding: 20px;
        }

        /* Style the form elements */
        .form-group label {
            font-weight: bold;
        }

        /* Style the submit button */
        .modal-footer .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        /* Style the submit button on hover */
        .modal-footer .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>

</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".review-button").click(function () {
                $(this).next(".review-form").toggle();
            });
        });
    </script>
    <!--header starts-->
    <header id="header" class="header-scroll top-header headrom">
        <!-- .navbar -->
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse"
                    data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/food-picky-logo.png"
                        alt=""> </a>
                <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span
                                    class="sr-only">(current)</span></a> </li>
                        <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Restaurants <span
                                    class="sr-only"></span></a> </li>

                        <?php
                        if (empty($_SESSION["user_id"])) {
                            echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">Sign Up</a> </li>';
                        } else {


                            echo '<li class="nav-item"><a href="your_orders.php" class="nav-link active">Your Orders</a> </li>';
                            echo '<li class="nav-item"><a href="logout.php" class="nav-link active">LogOut</a> </li>';
                        }

                        ?>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->
    </header>
    <div class="page-wrapper">
        <!-- top Links -->
        <div class="top-links">
            <div class="container">
                <ul class="row links">

                    <li class="col-xs-12 col-sm-4 link-item active"><span>1</span><a href="restaurants.php">Choose
                            Restaurant</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a href="#">Pick your favourite dishes</a>
                    </li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Get delivered & Pay</a></li>
                </ul>
            </div>
        </div>
        <!-- end:Top links -->
        <!-- start: Inner page hero -->
        <div class="inner-page-hero bg-image" data-image-src="images/img/res.jpeg">
            <div class="container"> </div>
            <!-- end:Container -->
        </div>
        <div class="result-show">
            <div class="container">
                <div class="row">


                </div>
            </div>
        </div>
        <!-- //results show -->
        <section class="restaurants-page">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3">


                        <div class="widget clearfix">
                            <!-- /widget heading -->
                            <div class="widget-heading">
                                <h3 class="widget-title text-dark">
                                    Popular tags
                                </h3>
                                <div class="clearfix"></div>
                            </div>
                            <div class="widget-body">
                                <ul class="tags">
                                    <li> <a href="#" class="tag">
                                            Thakali khana set
                                        </a> </li>
                                    <li> <a href="#" class="tag">
                                            Dum Biryani
                                        </a> </li>
                                    <li> <a href="#" class="tag">
                                            Yomori
                                        </a> </li>
                                    <li> <a href="#" class="tag">
                                            Newari Khaja Set
                                        </a> </li>
                                    <li> <a href="#" class="tag">
                                            Mocha Hot Chocolate
                                        </a> </li>
                                    <li> <a href="#" class="tag">
                                            Butter Naan
                                        </a> </li>
                                </ul>
                            </div>
                        </div>
                        <!-- end:Widget -->
                    </div>
                    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-9">
                        <div class="bg-gray restaurant-entry">
                            <div class="row">
                                <?php
                                $ress = mysqli_query($db, "select * from restaurant");
                                while ($rows = mysqli_fetch_array($ress)) {
                                    $restaurantId = $rows['rs_id'];
                                    $averageRating = calculateAverageRating($restaurantId); // Calculate average rating for this restaurant
                                    $totalReviews = $rows['total_reviews'];
                                    ?>

                                    <div class="restaurant-entry-container">
                                        <div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
                                            <div class="entry-logo">
                                                <a class="img-fluid" href="dishes.php?res_id=<?php echo $restaurantId; ?>">
                                                    <img src="admin/Res_img/<?php echo $rows['image']; ?>" alt="Food logo">
                                                </a>
                                            </div>
                                            <!-- end:Logo -->
                                            <div class="entry-dscr">
                                                <h5><a href="dishes.php?res_id=<?php echo $restaurantId; ?>">
                                                        <?php echo $rows['title']; ?>
                                                    </a></h5>
                                                <span>
                                                    <?php echo $rows['address']; ?> <a href="#">...</a>
                                                </span>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item"><i class="fa fa-check"></i> Min &#8360; 100
                                                    </li>
                                                    <li class="list-inline-item"><i class="fa fa-motorcycle"></i> 30 min
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- end:Entry description -->
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
                                            <div class="right-content bg-white">
                                                <div class="right-review">
                                                    <div class="rating-block">
                                                        <?php
                                                        for ($i = 1; $i <= 5; $i++) {
                                                            if ($i <= $averageRating) {
                                                                echo '<i class="fa fa-star"></i>';
                                                            } else {
                                                                echo '<i class="fa fa-star-o"></i>';
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <p>
                                                        <?php echo $totalReviews; ?> Reviews
                                                    </p>
                                                    <a href="dishes.php?res_id=<?php echo $restaurantId; ?>"
                                                        class="btn theme-btn-dash">View Menu</a>
                                                </div>
                                            </div>
                                            <!-- end:right info -->

                                            <button class="btn btn-danger review-button" data-toggle="modal"
                                                data-target="#reviewModal-<?php echo $restaurantId; ?>">Review</button>

                                            <!-- Review Modal -->
                                            <div class="modal fade" id="reviewModal-<?php echo $restaurantId; ?>"
                                                tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="reviewModalLabel">Add Your
                                                                Review</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="review.php" method="POST">
                                                                <input type="hidden" name="restaurant_id"
                                                                    value="<?php echo $restaurantId; ?>">
                                                                <div class="form-group">
                                                                    <label for="rating">Rating (1-5 stars):</label>
                                                                    <input type="number" name="rating" id="rating" min="1"
                                                                        max="5" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="comment">Comment:</label>
                                                                    <textarea name="comment" id="comment" rows="4"
                                                                        required></textarea>
                                                                </div>
                                                                <button type="submit" class="btn btn-danger">Submit
                                                                    Review</button>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                <?php } // End of the while loop ?>
                            </div>

                            <!--end:row -->
                        </div>



                    </div>



                </div>
            </div>
    </div>
    </section>

    <!-- start: FOOTER -->
    <footer class="footer">
        <div class="container">
            <!-- top footer statrs -->
            <div class="row top-footer">
                <div class="col-xs-12 col-sm-3 footer-logo-block color-gray">
                    <a href="#"> <img src="images/food-picky-logo.png" alt="Footer logo"> </a> <span>Choose it &amp;
                        Enjoy your meals! </span>
                </div>
                <div class="col-xs-12 col-sm-2 about color-gray">
                    <h5>About Us</h5>
                    <ul>
                        <li><a href="#"></a></li>
                        <li><a href="#"></a></li>
                        <li><a href="#"></a></li>
                        <li><a href="#"></a></li>
                        <li><a href="#"></a></li>
                    </ul>
                </div>

                <div class="col-xs-12 col-sm-3 popular-locations color-gray">
                    <h5>Locations We Deliver To</h5>
                    <ul>
                        <li><a href="#">Lalitpur</a> </li>
                        <li><a href="#">Kathmandu</a> </li>
                        <li><a href="#">Bhaktapur</a> </li>
                        <li><a href="#">Banepa</a> </li>
                        <li><a href="#">Dhulikhel</a> </li>

                    </ul>
                </div>
            </div>
            <!-- top footer ends -->

        </div>
    </footer>
    <!-- end:Footer -->
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>

</body>

</html>
<?php
// Calculate the average rating for a restaurant
function calculateAverageRating($restaurantId)
{
    global $db;
    $query = "SELECT AVG(rating) AS avg_rating FROM reviews WHERE restaurant_id = '$restaurantId'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    return round($row['avg_rating'], 1);
}
?>