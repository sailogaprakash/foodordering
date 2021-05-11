<?php
$connection = mysqli_connect("localhost", "root", "", "food-order");

session_start();
$msg = "";

if (isset($_POST['submit'])) {
  $firstname = mysqli_real_escape_string($connection, strtolower($_POST['first_name']));
  $lastname = mysqli_real_escape_string($connection, strtolower($_POST['last_name']));
  $email = mysqli_real_escape_string($connection, strtolower($_POST['email_id']));
  $username = mysqli_real_escape_string($connection, strtolower($_POST['user_name']));
  $password = mysqli_real_escape_string($connection, strtolower($_POST['password']));


  $signup_query = "INSERT INTO `tbl_user`(`user_id`, `first_name`, `last_name`, `email_id`, `user_name`, `password`) VALUES ('','$firstname','$lastname','$email','$username','$password')";

  $check_query = "SELECT * FROM `tbl_user` WHERE user_name='$username' or email_id='$email'";

  $check_res = mysqli_query($connection, $check_query);

  if (mysqli_num_rows($check_res) > 0) {
    $msg = '<div class="alert alert-warning" style="margin-top:30px";>
                      <strong>Failed!</strong> Username or Email already exists.
                      </div>';
  } else {
    $signup_res = mysqli_query($connection, $signup_query);
    $msg = '<div class="alert alert-success" style="margin-top:30px";>
                      <strong>Success!</strong> Registration Succefull.
                      </div>';
  }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="swal/sweetalert.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="swal/sweetalert.js"></script>
  <link rel="stylesheet" href="animate.css">
  <link rel="stylesheet" href="style.css">
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">







  <br>
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <?php echo $msg; ?>
        <div class="page-header">
          <h1 style="text-align: center;">Sign Up</h1>
        </div>
        <form class="form-horizontal animated bounce" action="" method="post">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="first_name" type="text" class="form-control" name="first_name" placeholder="First Name">
          </div>
          <br>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="last_name" type="text" class="form-control" name="last_name" placeholder="Lastname">
          </div>
          <br>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="email_id" type="email" class="form-control" name="email_id" placeholder="Email">
          </div>
          <br>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="user_name" type="text" class="form-control" name="user_name" placeholder="Username">
          </div>
          <br>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="password" type="password" class="form-control" name="password" placeholder="Password">
          </div>
          <br>

          <div class="input-group">
            <button type="submit" name="submit" class="btn btn-success">Sign Up</button>
            <p>
            <h2>After Creating Account,Click Log-in Button</h2>
            </p>
            <a href="login.php" class="btn btn-primary col-4 col-md-2">Log-in </a>

          </div>
      </div>

      </form>
    </div>
    <div class="col-md-3"></div>

  </div>

  </div>



</body>

</html>