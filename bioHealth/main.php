<?php
session_start();
include("connection.php");
if($_SESSION["name"] == ""){
  $ad = $_SESSION["name"] ;

  Header("Location: index.php");
  $sorgu = mysqli_query('SELECT * FROM users WHERE kullanici_adi=$ad');
  $hasta = mysqli_fetch_array($sorgu);
}
$ad = $_SESSION["kAdi"];
$secim = "SELECT * FROM users WHERE kullanici_adi='$ad'";
$calistir = mysqli_query($connection,$secim);
$row = mysqli_fetch_array($calistir);

if($row['id']== ""){

  Header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa</title>
    <link rel="stylesheet" href="animate.css">
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
            <a class="nav-link" aria-current="page"> Hoşgeldiniz :  <h4 style="color:white;">  <?php echo $row['ad']; ?> <?php echo $row['soyad']; ?>  </h4> </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="profile.php"> <h5> Profilim  </h5> </a>
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
<div class="splitview skewed">
        <div class="panel bottom">
            <div class="content">
                <div class="description">
                    <h1>Sağlığınız bizim için önemli!</h1>
                </div>

                <img src="resimc.jpg" alt="Original">
            </div>
        </div>

        <div class="panel top">
            <div class="content">
                <div class="description">
                    <h1> Sağlığınız bizim için önemli!</h1>
                </div>

                <img src="resimd.jpg" alt="Duotone">
            </div>
        </div>

        <div class="handle"></div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    var parent = document.querySelector('.splitview'),
        topPanel = parent.querySelector('.top'),
        handle = parent.querySelector('.handle'),
        skewHack = 0,
        delta = 0;

    if (parent.className.indexOf('skewed') != -1) {
        skewHack = 1000;
    }

    parent.addEventListener('mousemove', function(event) {
        
        delta = (event.clientX - window.innerWidth / 2) * 0.5;

        handle.style.left = event.clientX + delta + 'px';

        topPanel.style.width = event.clientX + skewHack + delta + 'px';
    });
});
    </script>
</body>
</html>