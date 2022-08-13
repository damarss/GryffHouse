<?php

require $_SERVER["DOCUMENT_ROOT"]."/data/connection.php";
header('Content-Type: application/json');

$keyword = "%".$_GET['keyword']."%";

$sql = "SELECT nama_barang FROM stuff 
        WHERE nama_barang LIKE ?;";

$stmt = $pdo->prepare($sql);
$stmt->execute([$keyword]);
if ($stmt) {
    $stmt = $stmt->fetchAll();
    if (sizeof($stmt) > 0)
        echo json_encode($stmt);
}
$pdo = null;
?>