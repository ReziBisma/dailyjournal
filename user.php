<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah User
    </button>
    <div class="row">
        <div class="table-responsive" id="user_data">
            <!-- Data user akan dimuat melalui AJAX -->
        </div>
        <!-- Modal Tambah -->
        <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalLabel">Tambah User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Masukkan Username" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gambar</label>
                                <input type="file" class="form-control" name="gambar">
                                <input type="hidden" name="gambar_lama" value="<?= $gambar_lama ?? ''; ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" value="Simpan" name="simpan" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    load_data();

    function load_data(page) {
        $.ajax({
            url: "user_data.php",
            method: "POST",
            data: { hlm: page },
            success: function (data) {
                $('#user_data').html(data);
            }
        });
    }

    $(document).on('click', '.halaman', function () {
        var page = $(this).attr("id");
        load_data(page);
    });
});
</script>

<?php
include "upload_foto.php";

if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $gambar = '';
    $nama_gambar = $_FILES['gambar']['name'] ?? '';
    $gambar_lama = $_POST['gambar_lama'] ?? '';

    // Proses upload gambar baru jika ada
    if (!empty($nama_gambar)) {
        $cek_upload = upload_foto($_FILES["gambar"]);

        if ($cek_upload['status']) {
            $gambar = $cek_upload['message'];

            // Hapus gambar lama jika ada
            if (!empty($gambar_lama) && file_exists("img/" . $gambar_lama)) {
                if (!unlink("img/" . $gambar_lama)) {
                    echo "<script>alert('Gagal menghapus gambar lama.');</script>";
                }
            }
        } else {
            echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=user';
            </script>";
            die;
        }
    } else {
        $gambar = $gambar_lama; // Gunakan gambar lama jika tidak ada gambar baru
    }

    // Proses UPDATE atau INSERT
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $stmt = $conn->prepare("UPDATE user SET username = ?, password = ?, gambar = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("sssi", $username, $password, $gambar, $id);
            $simpan = $stmt->execute();
        } else {
            die("Error pada query UPDATE: " . $conn->error);
        }
    } else {
        $stmt = $conn->prepare("INSERT INTO user (username, password, gambar) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sss", $username, $password, $gambar);
            $simpan = $stmt->execute();
        } else {
            die("Error pada query INSERT: " . $conn->error);
        }
    }

    if ($simpan) {
        echo "<script>
            alert('Simpan data sukses');
            document.location='admin.php?page=user';
        </script>";
    } else {
        echo "<script>
            alert('Simpan data gagal');
            document.location='admin.php?page=user';
        </script>";
    }

    $stmt->close();
    $conn->close();
}

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $gambar = $_POST['gambar'];

    if ($gambar != '') {
        //hapus file gambar
        unlink("img/" . $gambar);
    }

    $stmt = $conn->prepare("DELETE FROM user WHERE id =?");

    $stmt->bind_param("i", $id);
    $hapus = $stmt->execute();

    if ($hapus) {
        echo "<script>
            alert('Hapus data sukses');
            document.location='admin.php?page=user';
        </script>";
    } else {
        echo "<script>
            alert('Hapus data gagal');
            document.location='admin.php?page=user';
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>
