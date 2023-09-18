<?php
session_start();
error_reporting(0);

include("connection.php");
$ad = $_SESSION["kAdi"];
$secim = "SELECT * FROM users WHERE kullanici_adi='$ad'";
$calistir = mysqli_query($connection,$secim);
$row = mysqli_fetch_array($calistir);
if(isset($_POST["olustur"])){
    $sehir = $_POST["sehir"];
    $tarih = $_POST["tarih"];
    $hastane = $_POST["hastane"];
    $klinik = $_POST["klinik"];
    $doktor = $_POST["doktor"];
    $randevu_hasta = $_POST["kullanici_adi"];



$controlet = mysqli_query($connection,"SELECT * FROM appointment WHERE randevu_klinik='$klinik'");
if(!mysqli_num_rows($controlet))
{
if(mysqli_query($connection,"INSERT INTO appointment (randevu_sehir, randevu_tarih, randevu_hastane, randevu_doktor, randevu_klinik,kullanici_adi) 
VALUES ('$sehir','$tarih','$hastane','$doktor','$klinik','$randevu_hasta')"))
{
echo "Kayıt başarıyla eklendi...";
Header("Location: main.php");

$userCek = "INSERT INTO users (kullanici_adi) VALUES ('$randevu_hasta')";
$randevuCek = mysqli_query($connection );
}
}
else
{
$hata = "Aynı branştan randevu alamazsınız!";
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Randevu Al</title>
    <link rel="stylesheet" href="randevusayfa.css">
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
            <a class="nav-link" href="appointments.php"> <h5> Randevu Bilgilerim </h5> </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"> <h5> Randevu Al </h5> </a>
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
</br>

<div class="orta" id="randevu">
<form action = "randevual.php" method = "POST">
<input type ="hidden"  class="form-control" name="kullanici_adi" value="<?php echo $_SESSION["kAdi"];?>">
<?php echo "<h3>" .$hata. "</h3>";?>
    <input type = "date"  class="form-control" id="date" name="tarih">

<select name = "sehir" class="form-select" id="date">
    <option value="sehir"> ---Şehir Seçiniz--- </option>
    <option value="Ankara">Ankara</option>
    <option value="İstanbul">İstanbul</option>
    <option value="Eskişehir">Eskişehir</option>
    <option value="İzmir">İzmir</option>
</select>

<select name = "hastane" class="form-select" id="date">
    <option value="hastane"> ---Hastane Seçiniz--- </option>
    <option value="Medicana(ANKARA)">Medicana(ANKARA)</option>
    <option value="Liv Hospita(ANKARA)">Liv Hospita(ANKARA)</option>
    <option value="TOBB(ANKARA)"> TOBB(ANKARA) </option>
    <option value="Ortadoğu(ANKARA)">Ortadoğu(ANKARA)</option>
    <option value="Memorial(ANKARA)">Memorial(ANKARA)</option>
    <option value="Avcılar Hospital(İSTANBUL)">Avcılar Hospital(İSTANBUL)</option>
    <option value="Medical Park Bahçelievler(İSTANBUL)">Medical Park Bahçelievler(İSTANBUL)</option>
    <option value="Memorial(İSTANBUL)"> Memorial(İSTANBUL) </option>
    <option value="Yenibosna Safa Hastanesi(İSTANBUL)">Yenibosna Safa Hastanesi(İSTANBUL)</option>
    <option value="Acıbadem(ESKİŞEHİR)">Acıbadem(ESKİŞEHİR)</option>
    <option value="Eskişehir Özel Anadolu Hastanesi(ESKİŞEHİR)">Eskişehir Özel Anadolu Hastanesi(ESKİŞEHİR)</option>
    <option value="Özel Gürlife Hastanesi(ESKİŞEHİR)">Özel Gürlife Hastanesi(ESKİŞEHİR)</option>
    <option value="Medicana International(İZMİR)"> Medicana International(İZMİR) </option>
    <option value="Kent Hastanesi(İZMİR)">Kent Hastanesi(İZMİR)</option>
    <option value="Egepol Hastanesi(İZMİR)">Egepol Hastanesi(İZMİR)</option>
    <option value="Hayat Hastanesi(İZMİR)">Hayat Hastanesi(İZMİR)</option>
    <option value="Medifema Hastanesi(İZMİR)">Medifema Hastanesi(İZMİR)</option>
</select>

<select name = "klinik" class="form-select" id="date">
    <option value="klinik"> ---Klinik Seçiniz--- </option>
    <option value="Dahiliye(İç Hastalıkları)">Dahiliye(İç Hastalıkları)</option>
    <option value="Göz Hastalıkları">Göz Hastalıkları</option>
    <option value="Deri ve Zührevi Hastalıkları"> Deri ve Zührevi Hastalıkları </option>
    <option value="Endokrinoloji ve Metabolizma Hastalıkları"> Endokrinoloji ve Metabolizma Hastalıkları</option>
    <option value="Gastroenteroloji"> Gastroenteroloji </option>
    <option value="genel">Genel Cerrahi</option>
    <option value="Genel Cerrahi">Göğüs Hastalıkları</option>
    <option value="Hematoloji"> Hematoloji </option>
    <option value="kardiyoloji"> Kardiyoloji </option>
    <option value="Nöroloji"> Nöroloji </option>
    <option value="Romatoloji"> Romatoloji </option>
    <option value="Ruh Sağlığı ve Hastalıkları">Ruh Sağlığı ve Hastalıkları</option>
    <option value="Üroloji"> Üroloji </option>
    <option value="Kadın Hastalıkları ve Doğum"> Kadın Hastalıkları ve Doğum </option>
</select>

<select name = "doktor" class="form-select" id="date">
    <option value="doktor"> ---Doktor Seçiniz--- </option>
    <option value="Deniz Açıkalın"> Deniz Açıkalın </option>
    <option value="Ayşe Tanrıverdi"> Ayşe Tanrıverdi </option>
    <option value="Buğra Karagöz"> Buğra Karagöz </option>
    <option value="Fehmi Kutlu"> Fehmi Kutlu </option>
    <option value="Doğuşcan Güngören"> Doğuşcan Güngören </option>
    <option value="Aleyna Mahir"> Aleyna Mahir </option>
    <option value="Güzide Topçu"> Güzide Topçu </option>
    <option value="Selim Sipahi"> Selim Sipahi </option>
    <option value="Nuray Koparan"> Nuray Koparan </option>
    <option value="Ahmet Emir Yılmaz"> Ahmet Emir Yılmaz </option>
    <option value="Kadir Dağdelen"> Kadir Dağdelen </option>
    <option value="Burcu Üstünbaş"> Burcu Üstünbaş </option>
    <option value="Gülhanım Hatun"> Gülhanım Hatun </option>
    <option value="Atiye Zilan"> Atiye Zilan </option>
</select>

<div class="d-grid gap-2 col-6 mx-auto">
    <button type="submit" class="btn btn-danger" name ="olustur"> Randevu Oluştur </button>
</div>
</form>
</div>

<div class="orta" id="hekim">
<p> <h2 class="yazı"> Lütfen randevu saatinize Türkiye Cumhuriyeti kimlik kartı ile geliniz.
</br>
</br> BioHealth ailesi olarak sağlıklı günler dileriz.
</h2>
</p>
</div>

</body>
</html>