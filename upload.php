<?php
$targetDir = "uploads/";

// 1. Logika untuk Membuat Folder Otomatis jika belum ada
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// 2. LOGIKA UNTUK PROSES UPLOAD FILE
if (isset($_POST["submit"])) {
    $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Validasi apakah benar-benar gambar
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "<script>alert('File yang dipilih bukan gambar!'); window.location='index.html';</script>";
        $uploadOk = 0;
    }

    // Batasi ukuran file (Contoh: Maksimal 5MB)
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "<script>alert('Ukuran file terlalu besar! Maksimal 5MB.'); window.location='index.html';</script>";
        $uploadOk = 0;
    }

    // Batasi format file yang diperbolehkan
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "<script>alert('Hanya format JPG, JPEG, PNG & GIF yang diperbolehkan.'); window.location='index.html';</script>";
        $uploadOk = 0;
    }

    // Eksekusi pemindahan file jika lolos validasi
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "<script>alert('File berhasil diunggah!'); window.location='list-file.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat mengunggah file.'); window.location='index.html';</script>";
        }
    }
}

// 3. LOGIKA UNTUK PROSES HAPUS FILE
if (isset($_GET['delete'])) {
    $fileName = basename($_GET['delete']); // Menggunakan basename untuk keamanan URL Injection
    $filePath = $targetDir . $fileName;

    // Pastikan file memang ada sebelum dihapus
    if (file_exists($filePath)) {
        unlink($filePath);
        echo "<script>alert('File berhasil dihapus!'); window.location='list-file.php';</script>";
    } else {
        echo "<script>alert('File tidak ditemukan!'); window.location='list-file.php';</script>";
    }
}
?>