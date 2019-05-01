<?php
require_once("../resources/config.php");
?>
<?php
if (isset($_SESSION['oturum'])) {
  if(isset($_GET["ekle"])){
    $ürünid=$_GET['ekle'];
    $query = query("SELECT * FROM products WHERE product_id =" . escape_string($_GET['ekle']). "");
    confirm($query);
    setcookie('urun['.$ürünid.']',$ürünid,time()+86400);
    header('Location:'.$_SERVER['HTTP_REFERER']);
  }
  if(isset($_GET['cıkart'])){
    $ürünid=$_GET['cıkart'];
    $query = query("SELECT * FROM products WHERE product_id =" . escape_string($_GET['cıkart']). "");
    confirm($query);
    setcookie('urun['.$ürünid.']',$ürünid,time()-86400);
    header('Location:'.$_SERVER['HTTP_REFERER']);
  }
  if (isset($_GET['bosalt'])) {
      foreach ($_COOKIE['urun'] as $ürünid => $value) {
        setcookie('urun['.$ürünid.']',$ürünid,time()-86400);
      }
      header('Location:'.$_SERVER['HTTP_REFERER']);
    }
}
else {
  echo "Sepete Ürün Eklemek İçin Lütfen Giriş Yapınız";
  header('Refresh:2 ; login.php');
}
function SepetiGöster()
{
    if (isset($_COOKIE['urun'])) {
        foreach ($_COOKIE['urun'] as $name => $value) {
            $query = query("SELECT * FROM products WHERE product_id = ".escape_string($name) .""  );
            confirm($query);
            while ($row = fetch_array($query)) {
              $goster = <<<DELIMETER
            <p><strong> {$row['product_id']} *-*-*--*-*-*-*-*-* {$row['product_title']} <a class="btn btn-primary"  href="?cıkart={$row['product_id']}">Sepetten Çıkart</a>
            </strong> </p>
DELIMETER;
  echo $goster;
            }
        }
        echo '<a class="btn btn-danger"  href="?&bosalt=true">Sepeti Boşalt</a>';
    }
}
?>
