<?php
require_once("C://xampp/htdocs/Proje/resources/config.php"); // php dosyası çağırmak için.
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
  Ürün Ekleme Alanı

</h1>

</div>



<form action="" method="post" enctype="multipart/form-data">


<div class="col-md-8">

<div class="form-group">
    <label for="product-title">Ürün Adı </label>
        <input type="text" name="product_title" class="form-control" required="required">

    </div>


    <div class="form-group">
           <label for="product-title">Ürün Açıklaması</label>
      <textarea name="product_description" id="" cols="30" rows="10" class="form-control" required="required"></textarea>
    </div>



    <div class="form-group row">

      <div class="col-xs-3">
        <label for="product-price">Ürün Fiyatı</label>
        <input type="number" name="product_price" class="form-control" size="60">
      </div>
      <div class="col-xs-3">
        <label for="product-price">Stok Sayısı</label>
        <input type="number" name="urunSayisi" class="form-control" size="60">
      </div>
    </div>







</div><!--Main Content-->


<!-- SIDEBAR-->


<aside id="admin_sidebar" class="col-md-4">

  <?php add_product(); ?>
     <div class="form-group">

        <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Yayınla">
    </div>


     <!-- Product Categories-->

    <div class="form-group">
         <label for="product-title">Ürün Kategori</label>
          <hr>
        <select name="product_category_id" id="" class="form-control">
            <?php get_categories_in_options();  ?>
        </select>


</div>
<!-- Product Tags -->


    <div class="form-group">
          <label for="product-title">Ürün Kısa Açıklama</label>
          <hr>
        <textarea type="textarea" name="short_description" class="form-control" required="required"> </textarea>
    </div>

    <!-- Product Image -->
    <div class="form-group">
        <label for="product-title">Ürün Resmi</label>
        <input type="file" name="file">

    </div>



</aside><!--SIDEBAR-->



</form>







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
