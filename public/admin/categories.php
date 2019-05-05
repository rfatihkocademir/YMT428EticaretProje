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

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include(TEMPLATE_FRONT . DS . "admin_nav.php" ); ?>



        <div id="page-wrapper">

            <div class="container-fluid">





<h1 class="page-header">
  Product Categories

</h1>


<div class="col-md-4">

    <form action="" method="post">

        <div class="form-group">
            <label for="category-title">Kategori Adı</label>
            <input type="text" name="cat_title"class="form-control">
        </div>

        <div class="form-group">

            <input type="submit" name="submit" class="btn btn-primary" value="Add Category">
        </div>
          <?php  add_categories(); ?>

    </form>


</div>


<div class="col-md-8">

    <table class="table">
            <thead>

        <tr>
            <th>id</th>
            <th>Title</th>
        </tr>
            </thead>


    <tbody>
        <tr>
            <td>20</td>
            <td>Example Title</td>
        </tr>
    </tbody>

        </table>

</div>

















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
