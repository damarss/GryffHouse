<?php
require $_SERVER["DOCUMENT_ROOT"]."/data/connection.php";
header('Content-Type: application/json');

$sql = "SELECT m.*, r.review, AVG(r.rate) as rate FROM movie m 
        LEFT JOIN review r ON m.movieId = r.movieId
        GROUP BY m.title ORDER BY m.year";
$stmt = $pdo->query($sql);
$stmt = $stmt->fetchAll();
echo json_encode($stmt);
$pdo = null;