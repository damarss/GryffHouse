<?php

require $_SERVER["DOCUMENT_ROOT"]."/data/connection.php";
header('Content-Type: application/json');

$keyword = "%".$_GET['keyword']."%";

$sql = "SELECT s.*, u.phone, u.name as rate FROM stuff s 
        LEFT JOIN user u ON s.idUser = u.id WHERE s.nama_barang LIKE ? OR s.deskripsi_barang LIKE ?
        ORDER BY s.idStuff DESC;";

$stmt = $pdo->prepare($sql);
$stmt->execute([$keyword, $keyword]);
if ($stmt) {
    $stmt = $stmt->fetchAll();
    if (sizeof($stmt) > 0)
        echo json_encode($stmt);
    else
        echo "No result";
}
$pdo = null;