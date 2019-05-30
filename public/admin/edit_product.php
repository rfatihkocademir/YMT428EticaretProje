<?php
require_once("../../resources/config.php"); // php dosyası çağırmak için.
?>
<?php if (isset($_SESSION['oturum_admin'])) {
    echo $_SESSION['oturum_admin'];

}
else {
  header("Location:SayfaBulunamadı.php");
}
?>
<!DOCTYPE html>


<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include(TEMPLATE_FRONT . DS . "admin_nav.php" ); ?>


        <div id="page-wrapper">

            <div class="container-fluid">






<div class="col-md-12">

<div class="row">
<h1 class="page-header">
   Ürün Düzenle

</h1>
</div>



<?php edit_product(); ?>







            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
