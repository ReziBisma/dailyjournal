<?php
// Pastikan koneksi database tersedia
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Query untuk mengambil data article
$sql1 = "SELECT * FROM article ORDER BY tanggal DESC";
$hasil1 = $conn->query($sql1);

// Hitung jumlah baris data article
if ($hasil1) {
    $jumlah_article = $hasil1->num_rows;
} else {
    $jumlah_article = 0; // Fallback jika query gagal
    echo "Error pada query article: " . $conn->error;
}

// Query untuk mengambil data gallery
$sql2 = "SELECT * FROM gallery"; // Hilangkan ORDER BY tanggal jika kolom tanggal tidak ada
$hasil2 = $conn->query($sql2);

// Hitung jumlah baris data gallery
if ($hasil2) {
    $jumlah_gallery = $hasil2->num_rows;
} else {
    $jumlah_gallery = 0; // Fallback jika query gagal
    echo "Error pada query gallery: " . $conn->error;
}
?>

<div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center pt-4">
    <div class="col">
        <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="p-3">
                        <h5 class="card-title"><i class="bi bi-newspaper"></i> Article</h5> 
                    </div>
                    <div class="p-3">
                        <span class="badge rounded-pill text-bg-danger fs-2">
                            <?php echo $jumlah_article; ?>
                        </span>
                    </div> 
                </div>
            </div>
        </div>
    </div> 
    <div class="col">
        <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="p-3">
                        <h5 class="card-title"><i class="bi bi-camera"></i> Gallery</h5> 
                    </div>
                    <div class="p-3">
                        <span class="badge rounded-pill text-bg-danger fs-2">
                            <?php echo $jumlah_gallery; ?>
                        </span>
                    </div> 
                </div>
            </div>
        </div>
    </div> 
</div>
