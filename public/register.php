<?php
require_once("../resources/config.php"); // php dosyası çağırmak için.
?>

<?php
include(TEMPLATE_FRONT . DS . "header.php") // template dosyası çağırmak için.
?>

    <!-- Page Content -->
    <div class="container">

      <header>
            <h1 class="text-center">Kayıt Ol</h1>
            <?php display_message(); ?>
        <div class="col-sm-4 col-sm-offset-5">
            <form class="" action="" method="post" enctype="multipart/form-data">
              <?php register_user(); ?>
              <div class="form-group"><label for="">
                  <input type="text" name="username" class="form-control" placeholder="Kullanıcı Adı" required="required"></label>
              </div>
                <div class="form-group"><label for="">
                    <input type="text" name="email" class="form-control" placeholder=" Email" required="required"></label>
                </div>
                 <div class="form-group"><label for="password">
                    <input type="text" name="password" class="form-control" placeholder="Şifre" required="required"></label>
                </div>

                <div class="form-group">
                  <input type="submit" name="submit" class="btn btn-primary" >

                </div>

            </form>

        </div>


    </header>


        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <?php

        include(TEMPLATE_FRONT . DS . "footer.php");

        ?>
