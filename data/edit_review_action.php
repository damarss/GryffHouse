<?php 
session_start();
if (isset($_SESSION['username'])) {
    header("Location: index.php");
}
require 'connection.php';
$reviewId = $_POST['reviewId'];
$movieId = $_POST['movieId'];
$rate = $_POST['rate'];
$review = $_POST['review'];

$sql = "UPDATE review SET rate = ?, review = ?, tanggal = ? WHERE reviewId = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$rate, $review, date("Y-m-d"), $reviewId]);

$pdo = null;

echo "<script>
    alert('Review berhasil diubah');
    window.location.href = '/movie_detail.php?id=$movieId';
</script>";