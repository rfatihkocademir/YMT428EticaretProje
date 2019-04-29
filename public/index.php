<?php
require_once("../resources/config.php"); // php dosyası çağırmak için.
?>

<?php
include(TEMPLATE_FRONT . DS . "header.php") // template dosyası çağırmak için.
?>



    <!-- Page Content -->
    <div class="container">

        <div class="row">
          <!--kagetoriler burda-->
          <?php
          include(TEMPLATE_FRONT . DS . "side_nav.php") // template dosyası çağırmak için.

          ?>


            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                      <?php include(TEMPLATE_FRONT . DS . "carosel.php") ?>
                    </div>

                </div>

                <div class="row">

                    <?php get_products(); 
                    ?>





                </div>

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
