<?php

session_start();
require 'connection.php';

$sql = "DELETE FROM review WHERE reviewId = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_GET['id']]);
$pdo = null;
echo "<script>
    alert('Review berhasil dihapus!');
    document.location.href = '/movie_detail.php?id=$_GET[movieId]';
</script>";