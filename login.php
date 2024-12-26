<?php
// Memulai session
session_start();

// Menyertakan file koneksi
include "koneksi.php";

//check jika sudah ada user yang login arahkan ke halaman admin
if (isset($_SESSION['username'])) { 
	header("location:admin.php"); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil input dari form
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Sebaiknya gunakan password_hash dan password_verify

    // Validasi koneksi
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    // Prepared statement untuk query
    $stmt = $conn->prepare("SELECT username FROM user WHERE username=? AND password=?");
    if (!$stmt) {
        die("Prepare statement gagal: " . $conn->error);
    }

    // Bind parameter
    $stmt->bind_param("ss", $username, $password);

    // Eksekusi query
    $stmt->execute();

    // Ambil hasil query
    $hasil = $stmt->get_result();
    $row = $hasil->fetch_array(MYSQLI_ASSOC);

    // Cek hasil login
    if (!empty($row)) {
        // Jika login berhasil, simpan session
        $_SESSION['username'] = $row['username'];

        // Redirect ke halaman admin
        header("location:admin.php");
    } else {
        // Jika login gagal, redirect ke halaman login
        header("location:login.php");
    }

    // Menutup statement dan koneksi
    $stmt->close();
    $conn->close();
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - FigGraf</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
              integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
              crossorigin="anonymous">
        <style>
            body {
                background-color: #f8f9fa;
            }
            .login-container {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .login-card {
                width: 100%;
                max-width: 400px;
                border: 1px solid #ddd;
                border-radius: 10px;
                background-color: #ffffff;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                padding: 20px;
            }
            .login-title {
                text-align: center;
                font-weight: bold;
                margin-bottom: 20px;
            }
            .login-footer {
                text-align: center;
                margin-top: 10px;
                font-size: 0.9rem;
                color: #6c757d;
            }
        </style>
    </head>
    <body>
    <div class="login-container">
        <div class="login-card">
            <h3 class="login-title">FigGraf Login</h3>

            <!-- Form Login -->
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan Username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-info btn-block">Login</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
            crossorigin="anonymous"></script>
    </body>
    </html>
    <?php
}
?>
