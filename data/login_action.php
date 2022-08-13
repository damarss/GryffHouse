<?php
session_start();

require 'connection.php';

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM user WHERE username = ?");
$stmt->execute([$username]);
$stmt = $stmt->fetch();
if ($stmt) {
	if (password_verify($password, $stmt['password'])) {
		$_SESSION['user'] = $stmt;
		header('Location: /');
	} else {
		header('Location: /index.php?err=1');
	}
} else {
	header('Location: /index.php?err=1');
}

$pdo = null;
?>