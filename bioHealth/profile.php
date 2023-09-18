<?php
include("connection.php");
session_start();

$ad = $_SESSION["kAdi"];
$secim = "SELECT * FROM users WHERE kullanici_adi='$ad'";
$calistir = mysqli_query($connection,$secim);
$row = mysqli_fetch_array($calistir);

if($row['id']== ""){

  Header("Location: index.php");
}

if(empty($_POST)) {

}else{

$name = $_POST['name'];
$sname = $_POST['sname'];
$email = $_POST['email'];
$kullanici = $_POST['kullanici'];

// Profil bilgilerini güncelleme için
    $sql = "UPDATE users SET ad='$name',  soyad='$sname',  email='$email', kullanici_adi='$kullanici'  WHERE kullanici_adi='$ad'";
    $sonuc= mysqli_query($connection,$sql);
    if($sonuc>0) 
    { 
        Header("Location: index.php?bilgi=guncel");
    }
    else
    echo "Bir problem oluştu,lütfen verileri kontrol ediniz";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body style="background-color:rgb(44, 44, 44)">
<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class = "navbar-brand" href="main.php">
    <img src = "healthcare.png" width="64" height="60" >
        <b> BioHealth </b>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h4 class="offcanvas-title" id="offcanvasDarkNavbarLabel">BioHealth Sağlık Sistemine Hoşgeldiniz!</h4>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          </br>

          <li class="nav-item">
            <a class="nav-link" aria-current="page"> Hoşgeldiniz :  <h4 style="color:white;"> <?php echo $row['ad']; ?> <?php echo $row['soyad']; ?>  </h4> </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#"> <h5> Profilim  </h5> </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="appointments.php"> <h5> Randevu Bilgilerim </h5> </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="randevual.php" name="randevual"> <h5> Randevu Al </h5> </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php"> <button type="button" class="btn btn-outline-success"> Çıkış Yap </button> </a>
          </li>
          </ul>
        </li>
      </ul>
    </div>
    </div>
  </div>
</nav>
</div>
</br>
</br>
</br>
</br>
<div class="container p-5">
    <div class="card p-5" style="width: 60rem; height: 40rem; margin:auto;">
        <form action="profile.php" method="POST">
        <div class="mb-5"> <h3> <b> Profilimi Düzenle </b> </h3> </div>
        <div class="mb-2">
            <label for="exampleInputEmail1" class="form-label">Ad:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['ad']; ?>">
        </div>
        <div class="mb-2">
            <label for="exampleInputEmail1" class="form-label">Soyad:</label>
            <input type="text" class="form-control" id="surname" name="sname" value="<?php echo $row['soyad']; ?>">
        </div>
        <div class="mb-2">
            <label for="exampleInputPassword1" class="form-label">TC Kimlik No:</label>
            <input type="text" class="form-control" id="kimlik" name="kimlik" value="<?php echo $row['tcKimlikNo']; ?>" disabled>
        </div>
        <div class="mb-2">
            <label for="exampleInputPassword1" class="form-label">Email:</label>
            <input type="email" class="form-control" id="mail" name="email" value="<?php echo $row['email']; ?>">
        </div>
        <div class="mb-2">
            <label for="exampleInputPassword1" class="form-label">Kullanıcı Adı:</label>
            <input type="text" class="form-control id="username" name="kullanici" value="<?php echo $row['kullanici_adi']; ?>">
            <div class="invalid-feedback">
        </div>
        </br>
        <div class="btn btn-warning">
            <button type="submit" class="btn btn-warning" name="register"><i class="bi bi-pencil-square"> Bilgilerimi Düzenle </i></button>
        </div>
        </form>
    </div>
</div>
</body>
</html>
