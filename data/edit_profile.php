<?php
session_start();
require "connection.php";

$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$id = $_SESSION['user']['id'];
$password = $_POST['new-pass'];
$favhouse = $_POST['favhouse'];

$sql1 = "SELECT * FROM user WHERE username = ? AND id <> ?";

$stmt2 = $pdo->prepare($sql1);
$stmt2->execute([$username, $id]);

if ($stmt2->rowCount() != 0) {
    echo "<script>
            alert('Username already exists!');
            document.location.href = '/profile/profile';
        </script>";
} else {
    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET
            name = ?, email = ?, username = ?, phone = ?, favhouse = ?, password = ?
            WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $username, $phone, $favhouse, $password, $id]);
    } else {
        $sql = "UPDATE user SET
                name = ?, email = ?, username = ?, phone = ?, favhouse = ?
                WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $username, $phone, $favhouse, $id]);
    }

    $sql = "SELECT * FROM user WHERE id = '$id'";
    $stmt = $pdo->query($sql);
    $user = $stmt->fetch();

    $_SESSION['user'] = $user;

    $pdo = null;

    echo "<script>
        alert('Profile updated!');
        document.location.href = '/profile/profile.php';
    </script>";
}