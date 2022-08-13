<?php

use function PHPSTORM_META\type;

session_start();

require $_SERVER["DOCUMENT_ROOT"] . "/data/connection.php";

$idStuff = $_GET['id'];

$sql = "UPDATE stuff SET views = (views + 1) WHERE idStuff = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$idStuff]);

$sql = "SELECT s.*, u.phone, u.name FROM stuff s 
    LEFT JOIN user u ON s.idUser = u.id
    WHERE idStuff = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$idStuff]);

$stuff = $stmt->fetch();


$phone = $stuff['phone'];
if (substr($phone, 0, 1) == 0) {
    $phone = substr($phone, 1);
    $phone = '62' . $phone;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="/style/style.css">
    <link id="theme" rel="stylesheet" href="#">
    <link rel="stylesheet" href="/style/responsive.css">
    <title>Stuff - GryffHouse</title>
    <script src="https://kit.fontawesome.com/d4eb4a12db.js" crossorigin="anonymous"></script>
    <style>
        main {
            padding: 10px 7rem;
        }
    </style>
    <script src="/script/script.js"></script>
</head>

<body onload="themeLoader();">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/header.php') ?>
    <main>
        <h1 style="text-align: center;margin: 10px">Stuff</h1>
        <a class="btn" href="/stuff">Kembali</a>
        <div class="stuff-detail">
            <div class="stuff-detail-image">
                <img src="<?php echo $stuff['image_url'] ?>" alt="<?php echo $stuff['nama_barang'] ?>">
            </div>
            <div class="stuff-detail-text">
                <div class="stuff-detail-nama">
                    <?php echo $stuff['nama_barang'] ?>
                </div>
                <div class="stuff-detail-price">
                    <script>
                        document.writeln(formatter.format(<?php echo $stuff['harga'] ?>))
                    </script>
                </div>
                <div class="stuff-detail-deskripsi">
                    <h3>Deskripsi</h3>
                    <p><?php echo $stuff['deskripsi_barang'] ?></p>
                </div>
                <div class="stuff-detail-phone">
                    <p>Penjual: <b><?php echo $stuff['name'] ?></b></p>
                    <a href="https://api.whatsapp.com/send/?phone=<?php echo $phone ?>&text=Saya%20tertarik%20dengan%20produk%20Anda&app_absent=0" target="_blank" class="pesan"><i class="fa-brands fa-whatsapp"></i> Pesan</a>
                </div>
                <?php
                if (isset($_SESSION['user'])) {
                    if ($_SESSION['user']['id'] == $stuff['idUser'] || $_SESSION['user']['username'] == 'admin') {
                        echo '<div class="action">
                            <a href="/data/edit_stuff.php?id=' . $stuff['idStuff'] . '" class="btn"><i class="fas fa-edit"></i> Edit</a>
                            <a href="#delete-stuff" class="btn cons" onclick="hapusStuff(' . $stuff['idStuff'] . ')"><i class="fa-solid fa-trash-can"></i> Hapus</a>
                        </div>';
                    }
                }
                ?>
            </div>
        </div>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/login.php') ?>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/footer.php') ?>

    <script>
        document.getElementById('stuff').classList.add('active');
    </script>
</body>

</html>