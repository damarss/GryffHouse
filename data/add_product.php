<?php

session_start();
require 'connection.php';

$namaFile = $_FILES['berkas']['name'];
$namaSementara = $_FILES['berkas']['tmp_name'];

if ($_FILES['berkas']['size'] <= 1024000) {
    // tentukan lokasi file akan dipindahkan
    $dirUpload = "../uploads/";

    // pindahkan file
    $terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);

    if ($terupload) {
        $imageUrl = "/uploads/" . $namaFile;
        $namaBarang = $_POST['nama-barang'];
        $harga = $_POST['harga'];
        $deskripsi = $_POST['deskripsi'];
        $idUser = $_SESSION['user']['id'];

        $sql = "INSERT INTO stuff (nama_barang, harga, deskripsi_barang, image_url, idUser) 
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$namaBarang, $harga, $deskripsi, $imageUrl, $idUser]);

        echo "<script>
            alert('Barang berhasil ditambahkan!');
            document.location.href = '/stuff';
        </script>";
    } else {
        echo "Upload Gagal!";
    }

} else {
    echo "<script>
            alert('Ukuran file tidak boleh melebihi 1 MB!');
            document.location.href = '/stuff';
        </script>";
}