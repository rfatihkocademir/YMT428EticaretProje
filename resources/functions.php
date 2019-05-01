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
                <p>{$row['product_description']}</p>
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
        <p>{$row['product_description'] }</p>
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






function get_products_in_cat_page()//Veritabanından ürün bilgilerini çeken yardımcı fonksiyon
{
  $query = query("SELECT * FROM products WHERE product_category_id = " .escape_string($_GET['id']) ." ");
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
                <p>{$row['product_description']}</p>
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
        <img src="{$row['product_image']}" alt="">
            <div class="caption">
                <h4 class="pull-right">₺{$row['product_price']}</h4>
                <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                </h4>
                <p>{$row['product_description']}</p>
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
        setcookie('id['.$_SESSION['kullancıID'].']',$_SESSION['kullancıID'],time()+86400);
        echo $_SESSION["kullancıAdı"];
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
