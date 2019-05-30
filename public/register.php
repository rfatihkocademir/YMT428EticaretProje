<?php
require_once("../resources/config.php"); // php dosyası çağırmak için.
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V2</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<?php register_user(); ?>
<?php display_message(); ?>
<div class="limiter">
<div class="container-login100">
  <div class="wrap-login100">
    <form class="login100-form validate-form" method="post">
      <span class="login100-form-title p-b-26">
        Hoşgeldiniz
      </span>
      <span class="login100-form-title p-b-48">
        <i class="zmdi zmdi-font"></i>
      </span>

      <div class="wrap-input100 validate-input" >
        <input class="input100" type="text" name="username">
        <span class="focus-input100" data-placeholder="Kullanıcı Adı"></span>
      </div>

      <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
        <input class="input100" type="text" name="email">
        <span class="focus-input100" data-placeholder="Email"></span>
      </div>

      <div class="wrap-input100 validate-input" >
        <span class="btn-show-pass">
          <i class="zmdi zmdi-eye"></i>
        </span>
        <input class="input100" type="password" name="password">
        <span class="focus-input100" data-placeholder="Password"></span>
      </div>


      <div class="container-login100-form-btn">
        <div class="wrap-login100-form-btn">
          <div class="login100-form-bgbtn"></div>
          <button class="login100-form-btn" type="submit" name="submit">
            Kayıt Ol
          </button>
        </div>
      </div>

      <div class="text-center p-t-115">


        <a class="txt2" href="login.php">
          Giriş Yap
        </a>
      </div>
    </form>
  </div>
</div>
</div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <?php

        include(TEMPLATE_FRONT . DS . "footer.php");

        ?>
        <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/animsition/js/animsition.min.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/bootstrap/js/popper.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/select2/select2.min.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/daterangepicker/moment.min.js"></script>
        <script src="vendor/daterangepicker/daterangepicker.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/countdowntime/countdowntime.js"></script>
        <!--===============================================================================================-->
        <script src="js/main.js"></script>
