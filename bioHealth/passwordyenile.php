<?php
session_start();
include("connection.php");
error_reporting(0);

if(isset($_GET["yenile"])) {
  if(isset($_POST["sifre"]))
{
  
  $username_err = $password_err = $passagain_err = "";
  
 //parola denetleme
 if(empty($_POST["password"])){
    $password_err="Parola boş geçilemez.";
}else{
    $pass = password_hash($_POST["password"],PASSWORD_DEFAULT);
}

//parola tekrar denetleme
if(empty($_POST["passagain"])){
    $passagain_err = "Lütfen parolanızı tekrar giriniz.";
}else if($_POST["password"] != $_POST["passagain"]){
    $passagain_err = "Parolalar eşleşmedi.";
}else{
    $passagain = $_POST["passagain"];
}
$username = $_POST['kAdix'];

if((!empty($pass)) && (!empty($username))){
$new = $_POST["password"];
  if($new == $passagain){
// eğer değerler boş değil ise
$sql = "UPDATE users SET  password='$pass', kullanici_adi='$username'  WHERE kullanici_adi='$username'";
$kaydet = mysqli_query($connection, $sql);


$veri1 = '<div class="alert alert-success" role="alert">
<div id="uyari"></div>
</div>';
  }else{
    $veri1 = '<div class="alert alert-warning" role="alert">
Girdiğiniz şifreler eşleşmiyor
</div>';
  }

}else{
  //eğer gelen değerler boş ise
  $veri1 = '<div class="alert alert-danger" role="alert">
  Lütfen boşlukları doldurunuz.
</div>';
  }
}
}

if($_GET['bilgi'] == "yok"){

  $bilgi = '<div class="alert alert-danger" role="alert">
      Böyle bir kullanıcı adı mevcut değil!
</div>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şifremi Unuttum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body style="background-color:rgb(44, 44, 44)">
<div class="container p-4 mt-5">
    <img src="healthcare.png" class="rounded mx-auto d-block" style="width:100px; height:100px;">
    <h1 class="display-4" style="text-align: center; color:white;"> <b> BioHealth </b> </h1>
</div>
</br>
<div class="container p-5">
    <div class="card p-5" style="width: 80rem;">
        
        <div class="mb-5"> <h2> <b> Şifre Yenileme </b> </h2> </div>
        <?php if(!isset($_GET["yenile"])) { echo $bilgi;?>


          <form action="passwordyenile.php?yenile" method="POST">
        
          <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Kullancı Adı:</label>
         <input name="kAdix" class="form-control" required="required" type="text" placeholder="Kullanıcı Adınız...">
           
        </div>
       

        <div>
            <button type="submit" class="btn btn-success" > Şifremi Sıfırla</button>
        </div>

        </form>
        <?php  }else { 
        $ad = $_POST["kAdix"];

        $secim = "SELECT * FROM users WHERE kullanici_adi='$ad'";
        $calistir = mysqli_query($connection,$secim);
        $row = mysqli_fetch_array($calistir);

        if(empty($row['kullanici_adi'])){
          Header("Location: passwordyenile.php?bilgi=yok");

        }else{
          echo $veri1;
          ?>
          <script>
function ysYonlendir(ID, adres, saniye) {
  if (saniye == 0) {
    window.location.href = adres;
    return;
  }
  document.getElementById(ID).innerHTML = "Şifreniz yenilendi <b> " + saniye + "</b> saniye sonra yönlendiriliyorsunuz.";
  saniye--;
  setTimeout(function() {
    ysYonlendir(ID, adres, saniye);
  }, 1000);
}
</script>

<script>
  ysYonlendir("uyari", "http://localhost:8080/bioHealth/index.php?bilgi=sifre", 5);
</script>
          <form action="passwordyenile.php?yenile" method="POST">
          <div class="mb-3">
          <input value="<?php echo $ad; ?>" type="hidden" class="form-control"  name="kAdix">
            <label for="exampleInputPassword1" class="form-label">Parola:</label>
            <input type="password" class="form-control
            <?php
                if(!empty($password_err)){
                    echo "is-invalid";
                }
            ?>
            " id="password" name="password">
            <div class="invalid-feedback">
      <?php echo $password_err ?>
    </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Parola Tekrar:</label>
            <input type="password" class="form-control
            <?php
                if(!empty($passagain_err)){
                    echo "is-invalid";
                }
            ?>
            " id="password" name="passagain">
            <div class="invalid-feedback">
      <?php echo $passagain_err ?>
    </div>
        </div>

        <div>
            <button type="submit"  class="btn btn-success" name="sifre"> Şifremi Kaydet </button>
        </div>
        </form>
       <?php  } } ?>  
</div>
</div>
    </div>
</div>


</body>
</html>