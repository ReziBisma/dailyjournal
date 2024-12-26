<?php
include "koneksi.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>

    <style>
        html {
            scroll-behavior: smooth;
        }

        .header {
            background-color: #4e4e4e;
            padding: 10px;
            text-align: center;
            color: white;
        }

        .header h1 {
            margin: 0;
        }

        nav {
            text-align: center;
            margin-top: 10px;
        }

        nav a {
            display: inline-block;
            padding: 10px 20px;
            margin: 0 10px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }


        .container2{
            width: 100%;
            padding: 10px;
            border: 5px solid #333;
            border-radius: 30px;
            margin-bottom: 20px;
        }
        .container2 div{
            width: 120px;
            height: 120px;
            border: 5px solid black;
            border-radius: 30px;
            margin: 10px;
        }

        .main-content {
            display: flex;
            flex-direction: column;
            padding: 10px;
            margin: 0;
        }

        .main-content article {
            margin-bottom: 20px;
        }

        .kiri{
            float: left; width: 65%;
        }

        .container3{
            display: flex;
            padding: 10px;
            margin: 10px;
            box-sizing: border-box;
            background-color: lightgray;
        }

        .container3 div{
            padding: 10px;
            background-color: gray;
            border: 1px solid black;
            border-radius: 10px;
        }

        #dua{
            justify-content: space-evenly;
        }

        .main-content {
            display: flex;
            flex-direction: column;
            padding: 10px;
            margin: 0;
        }

        .footer {
            background-color: #4e4e4e;
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
        }

        .footer p {
            margin: 0;
        }

        @media (min-width: 768px) {
            .main-content {
                flex-direction: row;
            }

            .kiri {
                flex: 2;
                margin-right: 10px;
            }

            .aside {
                flex: 1;
            }
        }

        @media (max-width: 767px) {
            .main-content {
                flex-direction: column;
            }

            .container3 {
                flex-direction: column;
                align-items: center;
            }
        }

        @media (max-width: 480px) {
            .container3 div {
                margin-bottom: 10px;
            }
        }

    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-info bg-gradient sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">FigGraf</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="Home.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#galery">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#artikel">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#schedule">Jadwal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#profil">Tentang dia</a>
                    </li>
                </ul>
                <!-- Tombol Login -->
                <a href="login.php" class="btn btn-primary ms-2">Login</a>
            </div>
        </div>
    </nav>


    <section id="hero" class="container-fluid p-5 bg-light bg-primary-subtle">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12 text-center text-lg-start mb-4 mb-lg-0">
                <h1 class="display-4 fw-bold">Selamat Datang di FigGraf</h1>
                <p class="lead">Website dimana pembuatnya hanya ingin pamer foto figure diambil oleh beliau yang biasa aja hasilnya.</p>
                <p class="lead">Action figure adalah figur atau patung kecil yang sering berbentuk karakter fiksi dari film, serial televisi, komik, dan video game. 
                    Biasanya, action figure dibuat dengan detail tinggi dan sering memiliki titik artikulasi sehingga bisa digerakkan ke berbagai pose. 
                    Ini membuatnya menjadi objek yang menarik tidak hanya untuk koleksi, tetapi juga untuk keperluan fotografi..</p>
            </div>
            <div class="col-lg-6 col-md-12 text-center">
                <img src="img/Kafbiru.jpg" alt="Hero Image" class="img-fluid rounded" width=394 height=700>
            </div>
        </div>
    </section>
    
    <main>
    <!-- article begin -->
<section id="article" class="text-center p-5">
  <div class="container">
    <h1 class="fw-bold display-4 pb-3">article</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
      <?php
      $sql = "SELECT * FROM article ORDER BY tanggal DESC";
      $hasil = $conn->query($sql); 

      while($row = $hasil->fetch_assoc()){
      ?>
        <div class="col">
          <div class="card h-100">
            <img src="img/<?= $row["gambar"]?>" class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title"><?= $row["judul"]?></h5>
              <p class="card-text">
                <?= $row["isi"]?>
              </p>
            </div>
            <div class="card-footer">
              <small class="text-body-secondary">
                <?= $row["tanggal"]?>
              </small>
            </div>
          </div>
        </div>
        <?php
      }
      ?> 
    </div>
  </div>
</section>
<!-- article end -->


    <section id="gallery" class="py-5 p-5 bg-primary-subtle">
      <div class="container">
          <h2 class="text-center font-weight-bold mb-4">Galeri</h2>
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
              </ol>
              <div class="carousel-inner">
                  <div class="carousel-item active">
                      <img src="img/Zero.jpg" class="d-block w-100" alt="Gambar 1" style="height: 400px; object-fit: cover;">
                  </div>
                  <div class="carousel-item">
                      <img src="img/xgeats.jpg" class="d-block w-100" alt="Gambar 2" style="height: 400px; object-fit: cover;">
                  </div>
                  <div class="carousel-item">
                      <img src="img/Kaget.jpg" class="d-block w-100" alt="Gambar 3" style="height: 400px; object-fit: cover;">
                  </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
          </div>
      </div>
  </section>

    <section id="schedule" class="text-center p-5">
      <div class="container">
          <h3 class="fw-bold text-dark mb-4">-Jadwal & Kegiatan Mahasiswa-</h3>
          <div class="row row-cols-1 row-cols-md-4 g-3">
              <div class="col">
                  <div class="card text-white bg-primary">
                      <div class="card-body">
                          <h5 class="card-title">Senin</h5>
                          <p class="card-text">08:00 - 10:30<br>Normalnya sih Basdat<br>Ruang H.1.3</p>
                          <p class="card-text">13:00 - 15:00<br>Berekeliling awan<br>Ruang H.3.1</p>
                      </div>
                  </div>
              </div>
              <div class="col">
                  <div class="card text-white bg-success">
                      <div class="card-body">
                          <h5 class="card-title">Selasa</h5>
                          <p class="card-text">08:00 - 10:00<br>Pemrograman Berbasis Web<br>Ruang D.3.1</p>
                          <p class="card-text">13:00 - 15:00<br>Statistika<br>Ruang H.2.3</p>
                      </div>
                  </div>
              </div>
              <div class="col">
                  <div class="card text-white bg-danger">
                      <div class="card-body">
                          <h5 class="card-title">Rabu</h5>
                          <p class="card-text">08:00 - 10:00<br>Pemrograman Berorientasi Objek<br>Ruang D.2.2</p>
                          <p class="card-text">13:00 - 15:00<br>Rekayasa Perangkat Lunak<br>Ruang B.2.1</p>
                      </div>
                  </div>
              </div>
              <div class="col">
                  <div class="card text-dark bg-warning">
                      <div class="card-body">
                          <h5 class="card-title">Kamis</h5>
                          <p class="card-text">08:00 - 10:00<br>Pengantar Teknologi Informasi<br>Ruang F.3.1</p>
                          <p class="card-text">13:00 - 15:00<br>Rapat Koordinasi DOSCOM<br>Ruang Project C.3</p>
                      </div>
                  </div>
              </div>
              <div class="col">
                  <div class="card text-white bg-info">
                      <div class="card-body">
                          <h5 class="card-title">Jumat</h5>
                          <p class="card-text">08:00 - 11:00<br>Data Mining<br>Ruang F.2.3</p>
                          <p class="card-text">13:00 - 15:00<br>Information Retrieval<br>Ruang B.2.4</p>
                      </div>
                  </div>
              </div>
              <div class="col">
                  <div class="card text-white bg-secondary">
                      <div class="card-body">
                          <h5 class="card-title">Sabtu</h5>
                          <p class="card-text">08:30 - 10:00<br>Bimbingan Karier<br>Online</p>
                          <p class="card-text">13:00 - 15:00<br>Bimbingan Skripsi<br>Online</p>
                      </div>
                  </div>
              </div>
              <div class="col">
                  <div class="card text-dark bg-light">
                      <div class="card-body">
                          <h5 class="card-title">Minggu</h5>
                          <p class="card-text">00:00 - 24:00<br>Turu all time<br>Di rumah</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>

  <section  id="profil" class="py-5 container-fluid p-5 bg-light bg-primary-subtle">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Profil Mahasiswa</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card p-3 shadow-sm">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                            <img src="img/buron.png" alt="Foto Mahasiswa" class="img-fluid rounded-circle" style="width: 200px; height: 200px;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h4 class="card-title">Sinatrya Rezi Bisma Putra</h4>
                                <p class="card-text">Fotografer figure amatir</p>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th scope="row" style="width: 40%;">NIM</th>
                                            <td>: A11.2023.15174</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Program Studi</th>
                                            <td>: Teknik Informatika</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td>:111202315174@mhs.dinus.ac.id </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Telepon</th>
                                            <td>: +62 821355756565</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Alamat</th>
                                            <td>: Jl. Arjuna 3 Semarang</td>
                                        </tr>
                                        <tr>
                                          <th scope="row">Moto</th>
                                          <td>: Biarkan dia Memasak</td>
                                      </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


</main>
    
    <footer style="text-align: center; margin-top: 20px;" class="footer bg-info bg-gradient sticky-top">
        <p>TARAKARTA 2045</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
    crossorigin="anonymous"></script>
</body>
</html>