<?php session_start(); ?>
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
    <title>Home - GryffHouse</title>
    <script src="https://kit.fontawesome.com/d4eb4a12db.js" crossorigin="anonymous"></script>
</head>

<body onload="themeLoader(); changePicture();">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/header.php') ?>
    <main style="padding-top: 0; padding-left: 0; padding-right: 0;">
        <div class="intro">
            <div class="intro-text">
                <h1>GryffHouse</h1>
                <p>GryffHouse merupakan website yang dibuat untuk memberikan kebebasan kepada komunitas pencinta film Harry Potter untuk memberikan reviewnya pada film-film Harry Potter yang ada serta menyediakan tempat untuk siapapun yang ingin memajang produknya pada halaman Stuff agar dapat menjangkau lebih banyak konsumen.</p>
                <a class="btn" href="#fitur">Jelajahi Fitur</a>
            </div>
        </div>
        <div id="fitur" class="fitur">
            <h1>Fitur Utama</h1>
            <div class="fitur-wrapper">
                <div class="fitur-item" onclick="document.location.href = '#ss-review'">
                    <div class="fitur-item-text">
                        <h2>Review Film</h2>
                        <img src="/img/film.png" alt="Film">
                        <p>Berikan review untuk film-film Harry Potter.</p>
                    </div>
                </div>
                <div class="fitur-item" onclick="document.location.href = '#ss-product'">
                    <div class="fitur-item-text">
                        <h2>Pajang Product</h2>
                        <img src="/img/shopping.png" alt="Shopping">
                        <p>Pajang barang daganganmu disini.</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="ss-review" class="screenshot">
            <h1>Berikan Ulasan Terbaikmu</h1>
            <img src="/img/review.png" alt="Screenshot Review">
        </div>
        <div id="ss-product" class="screenshot">
            <h1>Pajang Barang Daganganmu</h1>
            <img id="screenshot" src="/img/product-1.png" alt="Screenshot Product">
        </div>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/login.php') ?>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/footer.php') ?>
    <script src="script/script.js"></script>
    <script>
        document.getElementById('home').classList.add('active');
    </script>
</body>

</html>