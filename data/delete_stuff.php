<?php

session_start();
require 'connection.php';

$sql = "DELETE FROM stuff WHERE idStuff = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_GET['id']]);
$pdo = null;
echo "<script>
    alert('Product berhasil dihapus!');
    document.location.href = '/stuff';
</script>";