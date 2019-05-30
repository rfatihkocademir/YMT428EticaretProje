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
  echo '<div class="text-center p-t-115">


    <a class="txt2" >
      Sepete Ürün Eklemek İçin Lütfen Giriş Yapınız
    </a>
  </div>';


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
            


<table class="table">
  <thead>
    <tr>

      <th scope="col">Ürün Adı</th>

      <th scope="col">Çıkart</th>
    </tr>
  </thead>
  <tbody>
    <tr>

      <td>{$row['product_title']}</td>

      <td><a class="btn btn-primary"  href="?cıkart={$row['product_id']}">Sepetten Çıkart</a></td>
    </tr>
  </tbody>
</table>
DELIMETER;
  echo $goster;
            }
        }
        echo '<a class="btn btn-danger"  href="?&bosalt=true">Sepeti Boşalt</a><br>';
        echo "<br> <a class= 'btn btn-primary'   href='onayla.php'>Sepeti Onayla </a>"  ;
    }
}
?>
