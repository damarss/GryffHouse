<?php
require $_SERVER["DOCUMENT_ROOT"] . "/data/connection.php";
header('Content-Type: application/json');

$sql = "SELECT * FROM stuff ORDER BY views DESC";
$stmt = $pdo->query($sql);
$stmt = $stmt->fetchAll();
echo json_encode($stmt);
$pdo = null;
