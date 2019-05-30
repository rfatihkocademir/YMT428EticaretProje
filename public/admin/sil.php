<?php
require_once("../../resources/config.php");
?>
<?php if (isset($_SESSION['oturum_admin'])) {
  if (isset($_GET['ürünid'])) {
    $ürünID= $_GET['ürünid'];
    $query = query("DELETE FROM `products` WHERE `products`.`product_id` = {$ürünID} ");
    confirm($query);
    header("Location:products.php");
  }
  if (isset($_GET['cat_id'])) {
    $cat_id=$_GET['cat_id'];
    $query = query("DELETE FROM `categories` WHERE `cat_id` = {$cat_id} ");
    confirm($query);
    header("Location:categories.php");
  }
}

?>
