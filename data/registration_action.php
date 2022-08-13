<?php

require "connection.php";

$name = $_POST['name'];
$email = $_POST['email'];
$username = $_POST['usrnm'];
$pass = $_POST['pwd'];
$pass_hash = password_hash($pass, PASSWORD_DEFAULT);
$phone = $_POST['phone'];

$sql = "SELECT * FROM user WHERE username = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$username]);
$stmt = $stmt->fetch();

if ($stmt['username'] == $username) {
    echo "<script>
            alert('Username already exists!');
            document.location.href = '/registration';
        </script>";
} else {
    if (isset($_POST['favhouse'])) {
                $favhouse = $_POST['favhouse'];
                $sql = "INSERT INTO user (username, email, password, name, favhouse, phone) 
                                VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$username, $email, $pass_hash, $name, $favhouse, $phone]);
        } else {
                $sql = "INSERT INTO user (username, email, password, name, phone) 
                        VALUES (?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$username, $email, $pass_hash, $name, $phone]);
    }

    $pdo = null;
    echo "<script>
            alert('Registration Successful');
            document.location.href='/index.php?err=0';
    </script>";
}

?>