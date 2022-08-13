<?php 
session_start();
if (isset($_SESSION['username'])) {
    header("Location: index.php");
}
require 'connection.php';
$idStuff = $_GET['id'];

$sql = "SELECT * FROM stuff WHERE idStuff = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$idStuff]);
$stmt = $stmt->fetch();

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="stylesheet" href="/style/style.css">
    <link id="theme" rel="stylesheet" href="">
    <link rel="stylesheet" href="/style/responsive.css">
    <title>Edit Stuff - GryffHouse</title>
    <script src="https://kit.fontawesome.com/d4eb4a12db.js" crossorigin="anonymous"></script>
</head>
<body onload="themeLoader()">
    <?php include($_SERVER['DOCUMENT_ROOT'].'/components/header.php') ?>
    <main>
        <form class="form-stuff" action="/data/edit_stuff_action" method="POST" enctype="multipart/form-data">
            <h1>Edit Stuff</h1>
            <input type="hidden" name="id" id="id" value="<?php echo $idStuff ?>">
            <label for="nama-barang">Nama Barang</label>
            <input type="text" name="nama-barang" id="nama-barang" placeholder="Nama barang" value="<?php echo $stmt['nama_barang'] ?>" required>
            <label for="berkas">Gambar Barang <span style="color: var(--secondary); font-size: 14px;">*Tidak perlu upload jika tidak ingin mengubah gambar</span></label>
            <input type="file" name="berkas" id="berkas" accept="image/png, image/jpeg" max-file-size="1024" value="<?php echo $stmt['image_url'] ?>">
            <label for="harga">Harga</label>
            <input type="number" name="harga" id="harga" min="0" placeholder="Harga barang misal 5000.25" step=".01" value="<?php echo $stmt['harga'] ?>" required>
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" placeholder="Masukkan deskripsi barang" required><?php echo $stmt['deskripsi_barang'] ?></textarea>
            <input type="submit" name="submit" id="submit" value="Edit Product">
        </form>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/components/footer.php') ?>

    <script src="/script/script.js"></script>
</body>
</html>