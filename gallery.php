<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah Gallery
    </button>
    <div class="row">
        <div class="table-responsive" id="gallery_data">
            <!-- Data gallery akan dimuat melalui AJAX -->
        </div>
        <!-- Modal Tambah -->
        <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalLabel">Tambah Gallery</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Judul</label>
                                <input type="text" class="form-control" name="judul" placeholder="Tuliskan Judul Gallery" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Isi</label>
                                <textarea class="form-control" name="isi" placeholder="Isi konten deskripsi galeri"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gambar</label>
                                <input type="file" class="form-control" name="gambar" required>
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
            url: "gallery_data.php",
            method: "POST",
            data: { hlm: page },
            success: function (data) {
                $('#gallery_data').html(data);
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
    $judul = $_POST['judul'];
    $isi = isset($_POST['isi']) ? $_POST['isi'] : '';
    $gambar = '';
    $nama_gambar = $_FILES['gambar']['name'];

    // Jika ada file yang dikirim
    if ($nama_gambar != '') {
        $cek_upload = upload_foto($_FILES["gambar"]);

        if ($cek_upload['status']) {
            $gambar = $cek_upload['message'];
        } else {
            echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=gallery';
            </script>";
            die;
        }
    }

    // Periksa apakah operasi adalah edit
    if (isset($_POST['id']) && $_POST['id'] != '') {
        $id = $_POST['id'];

        if ($gambar == '') {
            // Jika gambar tidak diganti, gunakan gambar lama
            $gambar = $_POST['gambar_lama'];
        } else {
            // Jika ganti gambar, hapus gambar lama
            unlink("img/" . $_POST['gambar_lama']);
        }

        $stmt = $conn->prepare("UPDATE gallery SET judul = ?, gambar = ?, isi = ? WHERE id = ?");
        if (!$stmt) {
            die("Error pada query UPDATE: " . $conn->error);
        }

        $stmt->bind_param("sssi", $judul, $gambar, $isi, $id);
    } else {
        // Jika tidak ada id, berarti insert data baru
        $stmt = $conn->prepare("INSERT INTO gallery (judul, gambar, isi) VALUES (?, ?, ?)");
        if (!$stmt) {
            die("Error pada query INSERT: " . $conn->error);
        }

        $stmt->bind_param("sss", $judul, $gambar, $isi);
    }

    $simpan = $stmt->execute();

    if ($simpan) {
        echo "<script>
            alert('Data berhasil disimpan.');
            document.location='admin.php?page=gallery';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menyimpan data.');
            document.location='admin.php?page=gallery';
        </script>";
    }

    $stmt->close();
    $conn->close();
}

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $gambar = $_POST['gambar'];

    if ($gambar != '') {
        if (file_exists("img/" . $gambar)) {
            unlink("img/" . $gambar); // Hapus file gambar
        }
    }

    $stmt = $conn->prepare("DELETE FROM gallery WHERE id = ?");
    if (!$stmt) {
        die("Error pada query DELETE: " . $conn->error);
    }

    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>
            alert('Gallery berhasil dihapus.');
            document.location='admin.php?page=gallery';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menghapus data.');
            document.location='admin.php?page=gallery';
        </script>";
    }

    $stmt->close();
}
?>

