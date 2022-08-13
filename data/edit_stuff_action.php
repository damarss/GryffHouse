<?php

session_start();
require 'connection.php';

if (!empty($_FILES['berkas']['name'])) {
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
            $idStuff = $_POST['id'];
    
            $sql = "UPDATE stuff SET nama_barang = ?, harga = ?, deskripsi_barang = ?, image_url = ?, 
                    idUser = ? WHERE idStuff = ?";
    
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$namaBarang, $harga, $deskripsi, $imageUrl, $idUser, $idStuff]);
    
            echo "<script>
                alert('Barang berhasil diedit!');
                document.location.href = '/stuff_detail?id=$idStuff';
            </script>";
        } else {
            echo "Upload Gagal!";
        }
    
    } else {
        echo "<script>
                alert('Ukuran file tidak boleh melebihi 1 MB!');
                document.location.href = '/edit_stuff?id=$idStuff';
            </script>";
    }
} else {
    $namaBarang = $_POST['nama-barang'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $idUser = $_SESSION['user']['id'];
    $idStuff = $_POST['id'];

    $sql = "UPDATE stuff SET nama_barang = ?, harga = ?, deskripsi_barang = ?, idUser = ?
            WHERE idStuff = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$namaBarang, $harga, $deskripsi, $idUser, $idStuff]);

    echo "<script>
    alert('Barang berhasil diedit!');
    document.location.href = '/stuff_detail?id=$idStuff';
    </script>";
}