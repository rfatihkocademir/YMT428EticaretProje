<div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">E-Sat</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li>
                <a href="shop.php">Shop</a>
            </li>


             <li><?php echo '<a href="checkout.php">Sepet</a>' ?>

            </li>
            <li>
              <?php if (isset($_SESSION["oturum"])) {

                echo '<a href = "cıkıs.php">Çıkış Yap</a>';

            }

            ?>
            </li>
            <li>
              <?php if (isset($_SESSION["oturum"])) {

                echo '<a href = "user.php">'.$_SESSION["kullancıAdı"].'</a>';

            }
                    else {
                    echo  '<li><a href="login.php">Giriş Yap</a></li>','<li><a href ="register.php">Kayıt Ol</a></li>';

                    }
            ?>

            </li>

        </ul>
    </div>
    <!-- /.navbar-collapse -->
</div>
