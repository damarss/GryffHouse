<?php

session_start();
require 'connection.php';

$userId = $_SESSION['user']['id'];
$rate = $_POST['rate'];
$review = $_POST['review'];
$movieId = $_POST['movieId'];
$date = date("Y-m-d");

$sql = "INSERT INTO review (userId, movieId, review, rate, tanggal) VALUES (?, ?, ?, ?, ?)";
$pdo->prepare($sql)->execute([$userId, $movieId, $review, $rate, $date]);
$pdo = null;


echo "<script>
    alert('Review berhasil ditambahkan!');
    document.location.href = '/movie_detail.php?id=$movieId';
</script>";