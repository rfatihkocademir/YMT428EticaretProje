<?php
require_once("../resources/config.php");
require_once("sepet.php"); // php dosyası çağırmak için.
?>

<?php
include(TEMPLATE_FRONT . DS . "header.php") // template dosyası çağırmak için.
?>
    <!-- Page Content -->
    <div class="container">
      <?php
      if (isset($_SESSION['oturum'])) {
        SepetiGöster();
      }
      else {
        
        header("Refresh:2; login.php ");
      }


       ?>


    </div>

        <!-- Footer -->
<?php

include(TEMPLATE_FRONT . DS . "footer.php");

?>
