<?php
//helper functions
function redirect($location){
  header("Location: $location");
}
function query($sql)
{
  global $connection;
  return mysqli_query($connection, $sql);
}
function confirm($result)
{
  global $connection;
  if (!$result) {
    die("QUERY ÇALIŞTIRILAMADI" . mysqli_error($connection));
  }
}

function escape_string($string)
{
  global $connection;
  return mysqli_real_escape_string($connection, $string);
}
function fetch_array($result)
{
  return mysqli_fetch_array($result);
}

//veritabanı fonksiyonları

function get_products()//Veritabanından ürün bilgilerini çeken yardımcı fonksiyon
{
  $query = query("SELECT * FROM products");
  confirm($query);

  while ($row = fetch_array($query)) {
    // HTML kodlarını DELIMETER'in içine atıp döngü haline getiriyoruz.
    $product = <<<DELIMETER
<div class="col-sm-4 col-lg-4 col-md-4">
      <div class="thumbnail">
        <img src="{$row['product_image']}" alt="">
            <div class="caption">
                <h4 class="pull-right">₺{$row['product_price']}</h4>
                <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                </h4>
                <p>{$row['short_description']}</p>
                <a class="btn btn-primary"  href="item.php?id={$row['product_id']}">Ürünü İncele</a>
            </div>
          </div>
  </div>
DELIMETER;
    echo $product;
  }
}
//-------------------------------------------------------------------------------
function get_products_in_item_page()//Veritabanından ürün bilgilerini çeken yardımcı fonksiyon
{
  $query = query("SELECT * FROM products WHERE product_id =" . escape_string($_GET['id']). "");
  confirm($query);

  while ($row = fetch_array($query)) {
    // HTML kodlarını DELIMETER'in içine atıp döngü haline getiriyoruz.
    $product = <<<DELIMETER
    <div class="row">
        <div class="col-md-7">
           <img class="img-responsive" src="{$row['product_image']}" alt="">
        </div>
        <div class="col-md-5">
            <div class="thumbnail">
        <div class="caption-full">
            <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
            <hr>
            <h4 class="">₺  {$row['product_price']} </h4>
        <div class="ratings">
        </div>
        <p>{$row['short_description'] }</p>
        <form action="">

            <div class="form-group" method="post">
                <a class="btn btn-primary"  href="sepet.php?ekle={$row['product_id']}">Sepete Ekle</a>
            </div>
        </form>
        </div>
    </div>
</div>
DELIMETER;
    echo $product;
  }



}









//-------------------------------------------------------------------------------

function get_categories_in_options()
{
  $query = query("SELECT * FROM categories");
  confirm($query);
  while($row = fetch_array($query)){

$categories_links = <<<DELIMETER
  <option href = '#' class= 'list-group-item' name="ürünKategorisi" value="{$row['cat_id']}" > {$row['cat_title']}</option>
DELIMETER;
echo $categories_links;
  }
}
function get_categories()
{
  $query = query("SELECT * FROM categories");
  confirm($query);
  while($row = fetch_array($query)){

$categories_links = <<<DELIMETER
  <a href = 'category.php?id={$row['cat_id']}' class= 'list-group-item'> {$row['cat_title']}</a>
DELIMETER;
echo $categories_links;
  }
}
function add_categories()
{
  if (isset($_POST['submit'])) {
    $cat_title = $_POST['cat_title'];
    $kategori_kayitlimi = query("SELECT * FROM categories WHERE cat_title = '{$cat_title}'");
    $kontrol = mysqli_num_rows($kategori_kayitlimi);

    if ($kontrol == 0) {
    $query= query("INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES (NULL, '{$cat_title}')");
    confirm($query);
    echo "Başarıyla Eklendi";
    }
    else {
      echo " Bu kategori zaten ekli !";
    }
  }
}
function add_product()
{

  $dosyaYolu = "uploads";
  if (isset($_POST['submit'])) {


    $product_title          = escape_string($_POST['product_title']);
    $product_category_id    = escape_string($_POST['cat_id']);
    $product_price          = escape_string($_POST['product_price']);
    $product_description    = escape_string($_POST['product_description']);
    $short_description      = escape_string($_POST['short_description']);
    $product_image          = escape_string($_FILES['file']['name']);
    $image_temp_location    = escape_string($_FILES['file']['tmp_name']);
    $UrunSayısı             = escape_string($_POST['urunSayisi']);
    $dosyaadı = rand( 0, 9999).$product_image;
    $yol = "../../resources/uploads/";
    $new_image_location     = $yol . $dosyaadı;

    copy($image_temp_location, $new_image_location);
    $veritabanı_resim_adresi = "../resources/uploads/".$dosyaadı;
    $ürün_kayitlimi = query("SELECT * FROM products WHERE product_title = '{$product_title}'");

    $kontrol = mysqli_num_rows($ürün_kayitlimi);
    if ($kontrol == 0) {
      $query = query("INSERT INTO `products` (`product_id`, `product_title`, `cat_id`, `product_price`, `product_description`, `short_description`, `product_image`, `urunSayisi`) VALUES
                                             (NULL, '$product_title', '$product_category_id', '$product_price', '$product_description', '$short_description', '$veritabanı_resim_adresi', '$UrunSayısı')");
    }
  }
}

function edit_product()
{
  $ürünID= $_GET['ürünid'];
  $query=query("SELECT * FROM products WHERE product_id = '{$ürünID}'");
  confirm($query);
  $row = fetch_array($query);

  $form = <<<DELİMETER
  <form action="" method="post" enctype="multipart/form-data">

  <div class="col-md-8">

  <div class="form-group">
      <label for="product-title">Ürün Adı </label>
          <input type="text" name="product_title" class="form-control" required="required" value="{$row['product_title']}">

      </div>


      <div class="form-group">
             <label for="product-title">Ürün Açıklaması</label>
        <textarea name="product_description" id="" cols="30" rows="10" class="form-control" required="required" value="{$row['product_description']}"></textarea>
      </div>



      <div class="form-group row">

        <div class="col-xs-3">
          <label for="product-price">Ürün Fiyatı</label>
          <input type="number" name="product_price" class="form-control" size="60" value="{$row['product_price']}">
        </div>
        <div class="col-xs-3">
          <label for="product-price">Stok Sayısı</label>
          <input type="number" name="urunSayisi" class="form-control" size="60" value="{$row['urunSayisi']}">
        </div>
      </div>
  </div><!--Main Content-->


  <!-- SIDEBAR-->


  <aside id="admin_sidebar" class="col-md-4">


       <div class="form-group">

          <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Yayınla">
      </div>


       <!-- Product Categories-->


  <!-- Product Tags -->


      <div class="form-group">
            <label for="product-title">Ürün Kısa Açıklama</label>
            <hr>
          <textarea type="textarea" name="short_description" class="form-control" required="required" value="{$row['short_description']}"> </textarea>
      </div>

      <!-- Product Image -->
      <div class="form-group">
          <label for="product-title">Ürün Resmi</label>
          <input type="file" name="file">

      </div>



  </aside><!--SIDEBAR-->



  </form>
DELİMETER;
echo $form;

  if (isset($_POST['submit'])) {


    $product_title          = escape_string($_POST['product_title']);

    $product_price          = escape_string($_POST['product_price']);
    $product_description    = escape_string($_POST['product_description']);
    $short_description      = escape_string($_POST['short_description']);
    $product_image          = escape_string($_FILES['file']['name']);
    $image_temp_location    = escape_string($_FILES['file']['tmp_name']);
    $UrunSayısı             = escape_string($_POST['urunSayisi']);
    $dosyaadı = rand( 0, 9999).$product_image;
    $yol = "../../resources/uploads/";
    $new_image_location     = $yol . $dosyaadı;

    copy($image_temp_location, $new_image_location);
    $veritabanı_resim_adresi = "..\\resources\\uploads\\".$dosyaadı;
    //UPDATE `products` SET `product_title` = 'asus Notebook', `product_category_id` = '5', `product_price` = '7933', `product_description` = 'sagfagsgapshıfbjlvnamskpğuphogubjknkmlkpopu9y8guıvkbjnasfasfasfasfdgasfasfas', `short_description` = 'ouıgyfgvnhjkmloşıugfythcgvnbjkojıuygftgcvbasfasf', `product_image` = '../resources/uploads/7617asus.jpg', `urunSayisi` = '987' WHERE `products`.`product_id` = 41;
      $query = query("UPDATE 'products' SET `product_title` = '{$product_title}', `product_price` = '{$product_price}',  `product_description` = '{$product_description}', `short_description` = '{$short_description}'WHERE `products`.`product_id` = {$ürünID}");
      $query2 = query("UPDATE 'products' SET `product_image` = '{$veritabanı_resim_adresi}', 'urunSayisi' = '{$UrunSayısı}' WHERE `products`.`product_id` = {$ürünID}");
      confirm($query);
      confirm($query2);
  }
}


function get_products_in_admin_page()
{
  $query = query("SELECT * FROM products");
  confirm($query);
  while ($row = fetch_array($query)) {
    $product = <<<DELIMETER
    <tr>
          <td>{$row['product_id']}</td>
          <td><img src="{$row['product_image']}" width="64" height="64" alt=""></td>
          <td>{$row['product_title']}</td>
          <td>{$row['cat_id']}</td>
          <td>{$row['product_price']}₺</td>
          <td><a type="submit" name="submit" class="btn btn-primary" href="edit_product.php?ürünid={$row['product_id']}" >Düzenle</a> <a type="submit" name="submit" class="btn btn-warning" href="sil.php?ürünid={$row['product_id']}">Sil</a> </td>
      </tr>
DELIMETER;
    echo $product;
  }
}

function get_categories_in_admin_page()
{
  $query = query("SELECT * FROM categories");
  confirm($query);
  while ($row = fetch_array($query)) {
    $product = <<<DELIMETER

  <tr>
      <td>{$row['cat_id']}</td>
      <td>{$row['cat_title']}</td>
      <td> <a type="submit" name="submit" class="btn btn-warning" href="sil.php?cat_id={$row['cat_id']}">Sil</a> </td>
  </tr>
DELIMETER;
echo $product;
  }
}






function get_products_in_cat_page()//Veritabanından ürün bilgilerini çeken yardımcı fonksiyon
{
  $query = query("SELECT * FROM products WHERE cat_id = " .escape_string($_GET['id']) ." ");
  confirm($query);

  while ($row = fetch_array($query)) {

    // HTML kodlarını DELIMETER'in içine atıp döngü haline getiriyoruz.
    $product = <<<DELIMETER
<div class="col-sm-4 col-lg-4 col-md-4">
      <div class="thumbnail">
        <img class="img-responsive" src="{$row['product_image']}" width="320" height="150" alt="">
            <div class="caption">
                <h4 class="pull-right">₺{$row['product_price']}</h4>
                <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                </h4>
                <p>{$row['short_description']}</p>
                <a class="btn btn-primary"  href="item.php?id={$row['product_id']}">Ürünü İncele</a>
            </div>
          </div>
  </div>
DELIMETER;
    echo $product;
  }
}

function get_products_in_shop_page()//Veritabanından ürün bilgilerini çeken yardımcı fonksiyon
{
  $query = query("SELECT * FROM products");
  confirm($query);
  while ($row = fetch_array($query)) {
    $product = <<<DELIMETER
<div class="col-sm-4 col-lg-4 col-md-4">
      <div class="thumbnail">
        <img src="{$row['product_image']}" width="320" height="150" alt="">
            <div class="caption">
                <h4 class="pull-right">₺{$row['product_price']}</h4>
                <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                </h4>
                <p>{$row['short_description']}</p>
                <a class="btn btn-primary"  href="item.php?id={$row['product_id']}">Ürünü İncele</a>
            </div>
          </div>
  </div>
DELIMETER;
    echo $product;
  }
}

function set_message($msg)
{
  if(!empty($msg)){
    $_SESSION['message'] = $msg;
  }
  else {
    $msg = "";
  }
}

function display_message()
{
  if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
  }
}


//************************************BackEnd***********************//

function login_user()
{
  if(isset($_SESSION['oturum_admin'])){ echo "Admin Girişi Yapılmış!";}
    else{
    if(isset($_POST['submit'])){
      $username = escape_string($_POST['username']);
      $password = escape_string($_POST['password']);



      $query = query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'");
      confirm($query);
      $row = fetch_array($query);
      if (mysqli_num_rows($query) == 0) {
        set_message("Kullanıcı Adı veya Şifreniz Yanlış!");
        redirect("login.php");
      }
      else {
        $_SESSION["oturum"] = true;
        $_SESSION["kullancıID"]= $row['user_id'];
        $_SESSION["kullancıAdı"] = $row['username'];
        $_SESSION["password"] = $password;
        $_SESSION["yetki"]  = 0;
        redirect("index.php");
      }
    }
  }

}
function admin_login()
{
  if(isset($_POST['submit'])){
    $username = escape_string($_POST['admin_username']);
    $password = escape_string($_POST['password']);



    $query = query("SELECT * FROM admin WHERE admin_username = '{$username}' AND admin_password = '{$password}'");
    confirm($query);
    $row = fetch_array($query);
    if (mysqli_num_rows($query) == 0) {

      redirect("admin_login.php");
    }
    else {
      $_SESSION["oturum_admin"] = true;
      $_SESSION["yetki"]  = 1;
      $_SESSION["adminID"]= $row['user_id'];
      $_SESSION["admin_username"] = $row['admin_username'];
      $_SESSION["password"] = $password;

      redirect("index.php");
    }
  }
}


function register_user()
{
  if(isset($_POST['submit'])){
    $username = escape_string($_POST['username']);
    $email = escape_string($_POST['email']);
    $password = escape_string($_POST['password']);
    //INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES (NULL, 'dmr', 'dmr@test.com', '123');
    //INSERT INTO users WHERE username = '{$username}' AND password = '{$password}'

    $mail_kayitlimi = query("SELECT * FROM users WHERE email = '{$email}'");
    $kontrol = mysqli_num_rows($mail_kayitlimi);
    if ($kontrol == 0) {
      $query = query("INSERT INTO users (`user_id`, `username`, `email`, `password`) VALUES(NULL,'{$username}','{$email}','{$password}')");
      confirm($query);
    }
    else {
      set_message("Bu E Posta Adresi Kullanımda!");
    }

  }
}

function get_reviews()
{

    $query = query("SELECT * FROM product_reviews WHERE product_id =" . escape_string($_GET['id']). "");
    confirm($query);
    while ($row = fetch_array($query)) {
      $reviews= <<<DELIMETER
      {$row['reviewers_name']}
      <p>{$row['product_review']}</p>

DELIMETER;
echo $reviews;
    }

}

function add_review()
{
  if(isset($_POST['submit'])){

    $product_id = escape_string($_GET['id']);
    $name = escape_string($_POST['name']);
    $review = escape_string($_POST['review']);
    $ekle = query("INSERT INTO `product_reviews` (`id`, `product_id`, `product_review`, `reviewers_name`) VALUES (NULL, '{$product_id}', '{$review}', '{$name}')");
    redirect("item.php?id={$product_id}");
  }


}

?>
