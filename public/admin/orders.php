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





        <div class="col-md-12">
<div class="row">
<h1 class="page-header">
   All Orders

</h1>
</div>

<div class="row">
<table class="table table-hover">
    <thead>

      <tr>
           <th>S.N</th>
           <th>Title</th>
           <th>Photo</th>
           <th>Quantity</th>
           <th>Invoice Number</th>
           <th>Order Date</th>
           <th>Status</th>
      </tr>
    </thead>
    <tbody>
        <tr>
            <td>21</td>
            <td>Nikon 234</td>

            <td><img src="http://placehold.it/62x62" alt=""></td>
            <td>Cameras</td>
            <td>456464</td>
            <td>Jun 2039</td>
           <td>Completed</td>
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
