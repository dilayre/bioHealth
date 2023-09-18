<?php
include("connection.php");
error_reporting(0);

$username_err = $password_err = "";
if(isset($_POST["kayit"])){
    Header("Location: register.php");
}

//butona basıldığında kaydedecek
if(isset($_POST["login"]))
{
    //kullanıcı adı denetleme
    if(empty($_POST["kullanici"])){
        $username_err = "Kullanıcı adı boş geçilemez!";
    }else{
        $username = $_POST["kullanici"];
        
    }

    //parola denetleme
    if(empty($_POST["password"])){
        $password_err="Parola boş geçilemez.";
    }else{
        $pass = $_POST["password"];
    }

///////////////////////////////////////////////////////////////////////////////////
    if(isset($username) && isset($pass)){
        $secim = "SELECT * FROM users WHERE kullanici_adi = '$username'";
        $calistir = mysqli_query($connection,$secim);
        $kayitsayisi = mysqli_num_rows($calistir); //çıkacak sonuç 1 veya 0 olabilir.

        if($kayitsayisi > 0)
        {
            $ilgilikayit = mysqli_fetch_assoc($calistir);
            $hashpass = $ilgilikayit["password"];

            if(password_verify($pass,$hashpass))
            {
                session_start();
                $_SESSION["name"] = $ilgilikayit["ad"];
                $_SESSION["sname"] = $ilgilikayit["soyad"];
                $_SESSION["sname"] = $ilgilikayit["soyad"];
                $_SESSION["kAdi"] = $_POST["kullanici"] ;
                Header("Location: main.php");

            }
            else
            {
                $veri4 = '<div class="alert alert-danger" role="alert">
               Kullanıcı adı veya şifre hatalı!
              </div>';
            }

        }
        else
        {
            $veri3 = '<div class="alert alert-danger" role="alert">
            Böyle bir kullanıcı yok!
          </div>';
        }

    }

    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body style="background-color:rgb(44, 44, 44)">
<div class="container p-4 mt-5">
    <img src="healthcare.png" class="rounded mx-auto d-block" style="width:100px; height:100px;">
    <h1 class="display-4" style="text-align: center; color:white;"> <b> BioHealth </b> </h1>
    </div>
</div>

<div class="container p-5">
    <div class="card p-5" style="width: 80rem;">
<?php 
if($_GET['bilgi'] == "guncel"){

    echo '<div class="alert alert-success" role="alert">
        Bilgileriniz güncellendi. Lütfen tekrar giriş yapınız.
  </div>';
}elseif($_GET['bilgi'] == "yeni"){

    echo '<div class="alert alert-success" role="alert">
       Kaydınız başarılı bir şekilde gerçekleşti.Lütfen giriş yapınız.
  </div>';
}elseif($_GET['bilgi'] == "sifre"){

    echo '<div class="alert alert-success" role="alert">
        şifreniz yenilendi giriş yapınız
  </div>';
  }

?>
        <form action="index.php" method="POST">
    
        <div class="mb-5"> <h2> <b> Giriş Yap </b> </h2> </div>
        <?php echo $veri3;?>
        <?php echo $veri4;?>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Kullanıcı Adı:</label>
            <input type="text" class="form-control
            <?php
                if(!empty($username_err)){
                    echo "is-invalid";
                }
            ?>
            " id="username" name="kullanici">
            <div class="invalid-feedback">
      <?php echo $username_err ?>
    </div>
        </div>
        <div class="mb-3">
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
        </br>
        <button type="submit" class="btn btn-primary" name="login"> Giriş Yap </button>
        <button type="submit" class="btn btn-success" name="kayit"> Kayıt Ol </button>
        </br>
        </br>
        <div>
            <a href="passwordyenile.php" style="color: #B71C1C" name=""> Şifremi Unuttum</a>
        </div>
        </br>
        </form>
</div>
</div>
</body>
</html>
