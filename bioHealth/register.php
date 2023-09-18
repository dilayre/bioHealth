<?php
include("connection.php");
error_reporting(0);

$username_err = $password_err = $passagain_err = "";
//butona basıldığında kaydedecek
if(isset($_POST["register"]))
{
    //kullanıcı adı denetleme
    if(empty($_POST["kullanici"])){
        $username_err = "Kullanıcı adı boş geçilemez!";
    }else if(strlen($_POST["kullanici"]) < 6){
        $username_err = "Kullanıcı adı en az 6 karakterden oluşmalıdır.";
    }else if(!preg_match('/^[a-z\d_]{5,20}$/i', $_POST["kullanici"])){
        $username_err = "Kullanıcı adı büyük,küçük harf ve rakamdan oluşmalıdır.";
    }else{
        $username = $_POST["kullanici"];
    }

    //parola denetleme
    if(empty($_POST["password"])){
        $password_err="Parola boş geçilemez.";
    }else{
        $pass = password_hash($_POST["password"],PASSWORD_DEFAULT);
    }

    //parola tekrar denetleme
    if(empty($_POST["passagain"])){
        $passagain_err = "Burayı boş geçemezsiniz.";
    }else if($_POST["password"] != $_POST["passagain"]){
        $passagain_err = "Parolalar eşleşmedi.";
    }else{
        $passagain = $_POST["passagain"];
    }

    // Kullanıcı ekleme işlemleri
    $ad = $_POST["name"];
    $sname = $_POST["sname"];
    $tc = $_POST["kimlik"];
    $email = $_POST["email"];
    $new = $_POST["password"];
    // form elemanlarından 1 tanesi bile boş olursa veya hepsi dolu olursa uygulanacak işlemler
        if(!empty($ad) && (!empty($sname)) && (!empty($tc)) && (!empty($email)) && (!empty($pass)) && (!empty($username))){
            if($new == $passagain){
                $tcx = $_POST["kimlik"];
            // eğer değerler boş değil ise
            $sorgu = "INSERT INTO users (ad, soyad, tcKimlikNo, email, password, kullanici_adi) VALUES ('$ad','$sname','$tcx','$email','$pass','$username')";
            $kaydet = mysqli_query($connection, $sorgu);
            Header("Location: index.php?bilgi=yeni");
            }else {
                $veri1 = '<div class="alert alert-warning" role="alert">
                Girdiğiniz şifreler eşleşmiyor
                </div>';

            }
        }else{
            //eğer gelen değerler boş ise
            $veri2 = '<div class="alert alert-danger" role="alert">
            Lütfen boş alan bırakmayınız.
          </div>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body style="background-color:rgb(44, 44, 44)">
<div class="container p-4 mt-5">
    <img src="healthcare.png" class="rounded mx-auto d-block" style="width:100px; height:100px;">
    <h1 class="display-4" style="text-align: center; color:white;""> <b> BioHealth </b> </h1>
    </div>
</div>
<div class="container p-5">
    <div class="card p-5" style="width: 80rem;">
        <form action="register.php" method="POST">
        <div class="mb-5"> <h2> <b> Kayıt Ol </b> </h2> </div>
        <?php echo $veri1;?>
        <?php echo $veri2;?>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Ad:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Soyad:</label>
            <input type="text" class="form-control" id="surname" name="sname">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">TC Kimlik No:</label>
            <input type="text" class="form-control" id="kimlik" name="kimlik">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Email:</label>
            <input type="email" class="form-control" id="mail" name="email">
        </div>
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
        </br>
        <button type="submit" class="btn btn-success" name="register"> Kayıt Ol</button>
        </br>
        </form>
</div>
</div>
</body>
</html>
