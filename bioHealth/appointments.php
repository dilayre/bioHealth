<?php
include("connection.php");
session_start();
error_reporting(0);

if($_SESSION["name"] == ""){

  Header("Location: index.php");

}

$veri = $_SESSION["kAdi"];
$verGET = $_POST["randevu_idx"];
$ad = $_SESSION["kAdi"];
$secim = "SELECT * FROM users WHERE kullanici_adi='$ad'";
$calistir = mysqli_query($connection,$secim);
$row = mysqli_fetch_array($calistir);

if($row['id']== ""){

  Header("Location: index.php");
}


if(empty($verGET)){


}else{
  //güncelleme için SQL sorgumuzu yazıyoruz.
  $sql = "DELETE FROM appointment WHERE randevu_id =$verGET";

 
  //sorgumuzu çalıştırıyoruz
  $sonuc= mysqli_query($connection,$sql);
  print_r($sql);
}
if($sonuc>0) 
{ 

echo 'Başarıyla güncellendi;';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Randevularım</title>
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
            <a class="nav-link active" aria-current="page" href="profile.php"> <h5> Profilim  </h5> </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"> <h5> Randevu Bilgilerim </h5> </a>
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
</br>
</br>
</br>
</br>
<main>
<div class="container">
    <div class="row mt-4">
        <div class="col">
<table class="table table-success">

<thead>
<tr>
    <th>Randevu Tarihi</th>
    <th>Şehir</th>
    <th>Hastane</th>
    <th>Klinik</th>
    <th>Doktor</th>
    <th>Randevumu Düzenle</th>
    
</tr>
</thead>
<tbody>

<?php
$sql = "SELECT * FROM appointment WHERE kullanici_adi='".$veri."'";

$result = $connection->query($sql);
if ($result->num_rows > 0) {
    // satırı tabloya dökmesi için
    while($row = $result->fetch_assoc()) {
      
      echo '<tr>
      <td>'.$row['randevu_tarih'].'</td>
      <td>'.$row['randevu_sehir'].'</td>
      <td>'.$row['randevu_hastane'].'</td>
      <td>'.$row['randevu_klinik'].'</td>
      <td>'.$row['randevu_doktor'].'</td>
      
      <form action="" method="post">
     <input type="hidden" name="randevu_idx" value="'.$row['randevu_id'].'">
      <td><button type="submit" class="btn btn-danger">Randevumu Sil </button></td></form>';
    }
      echo '   </tr>';
    }
    else
    {
    echo '<div class="alert alert-warning" role="alert">
    Aktif randevunuz bulunmamaktadır.
  </div>';
  }

$connection->close();
?>
</div>
</tbody>
</table>
  </div>
  </div>
</div>
</main>
</body>
</html>