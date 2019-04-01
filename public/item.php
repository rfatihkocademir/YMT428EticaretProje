<?php
require_once("../resources/config.php"); // php dosyası çağırmak için.
?>

<?php
include(TEMPLATE_FRONT . DS . "header.php") // template dosyası çağırmak için.
?>


    <!-- Navigation -->


    <!-- Page Content -->
<div class="container">

       <!-- Side Navigation -->

       <?php
       include(TEMPLATE_FRONT . DS . "side_nav.php") // template dosyası çağırmak için.
       ?>
       <?php

      $query = query("SELECT * FROM products WHERE product_id =" .escape_string($_GET['id']) ." ");
      confirm($query);
      while ($row = fetch_array($query)):





        ?>


<div class="col-md-9">

<!--Row For Image and Short Description-->

<?php get_products_in_item_page(); ?>


</div><!--Row For Image and Short Description-->


        <hr>


<!--Row for Tab Panel-->

<div class="row">

<div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>

  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">

<p></p>

    <p>
    <?php echo $row['product_description'] ?>
    </p>



    </div>
    <div role="tabpanel" class="tab-pane" id="profile">

  <div class="col-md-6">

       <h3>2 Reviews From </h3>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <?php get_reviews(); ?>
            </div>
        </div>







    </div>


    <div class="col-md-6">
        <h3>Add A review</h3>

     <form action="" class="form-inline" method="post">
        <div class="form-group">
            <label for="">Name</label>
                <input name="name"type="text" class="form-control" >
            </div>
             <div class="form-group">
            <label for="">Email</label>
                <input name="email"type="test" class="form-control">
            </div>
            <br>
             <div class="form-group">
             <textarea name="review" id="" cols="60" rows="10" class="form-control"></textarea>
            </div>

             <br>
              <br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="SUBMIT">
            </div>
        </form>

    </div>

 </div>

 </div>

</div>


</div><!--Row for Tab Panel-->




</div> <!--COLMD9Sonu -->
<?php endwhile; ?>
</div>
    <!-- /.container -->

    <?php

    include(TEMPLATE_FRONT . DS . "footer.php");

    ?>
