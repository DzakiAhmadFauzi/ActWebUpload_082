<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar File</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container gallery-container">
        <h2>File yang Telah Diunggah</h2>
        <nav>
            <a href="index.html">Upload</a> | 
            <a href="list-file.php" class="active">Lihat Daftar File</a>
        </nav>

        <div class="file-grid">
            <?php
            $dir = "uploads/";
            
            // Membaca file di dalam folder (mengabaikan titik sistem . dan ..)
            if (is_dir($dir) && $files = array_diff(scandir($dir), array('.', '..'))) {
                foreach ($files as $file) {
                    $filePath = $dir . $file;
                    echo "
                    <div class='file-card'>
                        <div class='img-box'>
                            <img src='$filePath' alt='$file'>
                        </div>
                        <div class='file-info'>
                            <p class='file-name' title='$file'>$file</p>
                            
                            <div class='action-buttons'>
                                <a href='$filePath' download class='btn-download'>Download</a>
                                <a href='upload.php?delete=$file' class='btn-delete' onclick='return confirm(\"Apakah Anda yakin ingin menghapus file ini?\")'>Hapus</a>
                            </div>
                            
                        </div>
                    </div>";
                }
            } else {
                echo "<p class='empty-msg'>Belum ada file yang diunggah.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>