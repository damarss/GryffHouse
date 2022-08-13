<?php

require $_SERVER["DOCUMENT_ROOT"]."/data/connection.php";
header('Content-Type: application/json');

$keyword = "%".$_GET['keyword']."%";

$sql = "SELECT m.*, r.review, AVG(r.rate) as rate FROM movie m 
        LEFT JOIN review r ON m.movieId = r.movieId
        WHERE m.title LIKE ? OR m.year LIKE ?
        GROUP BY m.title ORDER BY m.year;";
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
?>