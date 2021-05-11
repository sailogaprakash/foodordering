<?php
require 'db.php';
session_start();
$total = 0;
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");
    exit();
} else {
    if (isset($_GET['id'])) {
        $sql = "select * from tbl_cart where user_id=$_SESSION[user_id] and food_id=$_GET[id]";
        $res = mysqli_query($con, $sql);

        if (mysqli_num_rows($res) > 0) {
            while ($rows = mysqli_fetch_assoc($res)) {
                $quantity = $rows['quantity'];
                $quantity++;
                $sql2 = "update tbl_cart set quantity=$quantity where user_id=$_SESSION[user_id] and food_id=$_GET[id]";
                $res3 = mysqli_query($con, $sql2);
            }
        } else {
            $user_id = $_SESSION['user_id'];
            $pid = $_GET['id'];
            $res = "insert into tbl_cart(user_id,food_id,quantity) values($user_id,$pid ,1)";
            mysqli_query($con, $res);
        }
    }
    $sql = "select * from tbl_cart where user_id=$_SESSION[user_id]";
    $res1 = mysqli_query($con, $sql);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/srs.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">

            <h2 class="text-center text-white">Cart Details.</h2>

            <form action="#" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <?php
                    $pname = "";
                    $quan = "";
                    if (mysqli_num_rows($res1) > 0) {
                        while ($rows = mysqli_fetch_assoc($res1)) {

                            $sql2 = "select * from tbl_food where id= $rows[food_id]";
                            $res2 = mysqli_query($con, $sql2);

                            while ($row = mysqli_fetch_assoc($res2)) {
                                $total += $row['price'] * $rows['quantity'];

                    ?>
                                <div class="food-menu-img">

                                    <img src="<?= $row['image_name']; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                </div>

                                <div class="food-menu-desc">
                                    <h4><?= $row['title']; ?></h4>
                                    <p>Total Fat13.0 g
                                        Saturated Fat5.0 g
                                        Polyunsaturated Fat0.0 g
                                        Monounsaturated Fat0.0 g
                                        Cholesterol25.0 mg
                                        Sodium570.0 mg
                                        Potassium0.0 mg
                                        Total Carbohydrate27.0 g
                                        Dietary Fiber1.0 g
                                        Sugars2.0 g
                                        Protein11.0 g</p>


                                    <p class="food-price">Rs<?= $row['price']; ?></p>
                                    <div class="order-label">Quantity: <?= $rows['quantity']; ?></div>


                                </div>

                        <?php
                            }
                        } ?>

                </fieldset>


                <fieldset>
                    <legend></legend>

                    <a href="bill.php" class="btn btn-primary col-4 col-md-2">confrim order </a>
                    <a href="removecart.php" class="btn btn-primary col-4 col-md-2">Remove </a>
                </fieldset>

            </form>

        </div>
    </section>
<?php
                    }
?>
<center>
    <?php $_SESSION['title'] = $pname;
    $_SESSION['quantity'] = $quan;
    $_SESSION['price'] = $total; ?>
    <div class="w3-panel w3-center w3-padding w3-tag w3-text-whit w3-yellow w3-round">
        <p class="w3-panel w3-padding w3-large">Amount to be paid : Rs <?php echo $total; ?></p>
        <p class="w3-panel w3-padding">Cash on Delivery only*</p>

        <form class="w3-hover-yellow w3-yellow w3-center" action="cash.php" method="post">
            <input type="submit" value="Checkout" class="w3-center w3-padding w3-text-red w3-hover-red w3-hover-text-white w3-button w3-yellow w3-float-center" name="checkout">
        </form>
    </div>

</center>

<!-- fOOD sEARCH Section Ends Here -->

<!-- social Section Starts Here -->
<section class="social">
    <div class="container text-center">
        <ul>
            <li>
                <a href="https://www.facebook.com/"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png" /></a>
            </li>
            <li>
                <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png" /></a>
            </li>
            <li>
                <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png" /></a>
            </li>
        </ul>
    </div>
</section>
<!-- social Section Ends Here -->

<!-- footer Section Starts Here -->
<section class="footer">
    <div class="container text-center">
        <p>
            <center> Beleive us! We give best!,SRS restaurant,Developed By Rohinth,Sai,Sownder@2021</center>
        </p>
    </div>
</section>
<!-- footer Section Ends Here -->


</body>

</html>