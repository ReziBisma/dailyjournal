<?php
session_start();
include "koneksi.php";  

// Cek jika belum ada user yang login, arahkan ke halaman login
if (!isset($_SESSION['username'])) { 
    header("location:login.php"); 
} 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Daily Journal | Admin</title>
    <link rel="icon" href="img/logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" /> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
        body {
            background-color: #f5f5f5;
        }

        .navbar {
            background: linear-gradient(90deg, #00b4d8, #48cae4);
        }

        .navbar-brand, .nav-link {
            color: white !important;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
        }

        #content {
            background-color: #cfe8fc; /* Biru muda */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h4 {
            color: #333;
        }

        footer {
            background-color: #48cae4;
            color: white;
            padding: 20px;
        }

        footer a {
            color: white;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .footer i {
            color: white;
        }

        .footer i:hover {
            color: #333;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href=".">My Daily Journal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php?page=dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php?page=article">Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php?page=gallery">Gallery</a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php?page=user">user</a>
                    </li> 
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $_SESSION['username']?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li> 
                        </ul>
                    </li> 
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <section id="content" class="mt-4 mb-5">
        <div class="container">
            <?php
            if(isset($_GET['page'])){
            ?>
                <h4 class="lead display-6 pb-2 border-bottom border-primary"><?= ucfirst($_GET['page'])?></h4>
                <?php
                include($_GET['page'].".php");
            }else{
            ?>
                <h4 class="lead display-6 pb-2 border-bottom border-primary">Dashboard</h4>
                <?php
                include("dashboard.php");
            }
            ?>
        </div>
    </section>

    <!-- Footer -->
    <footer style="text-align: center; margin-top: 20px;" class="footer bg-info bg-gradient sticky-top">
        <p>TARAKARTA 2045</p>
    <div class="mb-3">
        <a href="https://www.instagram.com/udinusofficial" class="text-white mx-2" style="text-decoration: none;">
            <i class="bi bi-instagram h2"></i>
        </a>
        <a href="https://twitter.com/udinusofficial" class="text-white mx-2" style="text-decoration: none;">
            <i class="bi bi-twitter h2"></i>
        </a>
        <a href="https://wa.me/+62812685577" class="text-white mx-2" style="text-decoration: none;">
            <i class="bi bi-whatsapp h2"></i>
        </a>
    </div>
    <div>Sinatrya Rezi Bisma Putra &copy; 2023</div>
    </footer>


    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
