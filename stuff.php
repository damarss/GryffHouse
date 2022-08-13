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
    <title>Stuff - GryffHouse</title>
    <script src="https://kit.fontawesome.com/d4eb4a12db.js" crossorigin="anonymous"></script>
</head>

<body onload="themeLoader(); loadStuff()">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/header.php') ?>
    <main>
        <h1 style="text-align: center; margin: 10px">Stuff</h1>

        <div class="stuff-container">
            <div class="sidebar-stuff">
                <h2>Sort By</h2>
                <nav>
                    <ul>
                        <li><a id="sterpopuler" href="#sort-terpopuler" onclick="sortStuff('populer', this)"><i class="fa-solid fa-fire-flame-curved"></i> Terpopuler</a></li>
                        <li><a id="sterbaru" href="#sort-terbaru" onclick="sortStuff('terbaru', this)"><i class="fa-solid fa-clock"></i> Terbaru</a></li>
                        <li><a id="sterlama" href="#sort-terlama" onclick="sortStuff('terlama', this)"><i class="fa-solid fa-clock"></i> Terlama</a></li>
                        <li><a id="stermurah" href="#sort-termurah" onclick="sortStuff('termurah', this)"><i class="fa-solid fa-dollar-sign"></i> Termurah</a></li>
                        <li><a id="stermahal" href="#sort-termahal" onclick="sortStuff('termahal', this)"><i class="fa-solid fa-dollar-sign"></i> Termahal</a></li>
                        <li><a id="snamaasc" href="#sort-by-nama-A-Z" onclick="sortStuff('namaasc', this)"><i class="fa-solid fa-arrow-down-a-z"></i> Nama (A-Z)</a></li>
                        <li><a id="snamadesc" href="#sort-by-nama-Z-A" onclick="sortStuff('namadesc', this)"><i class="fa-solid fa-arrow-down-z-a"></i> Nama (Z-A)</a></li>
                    </ul>
                </nav>
            </div>
            <div class="stuff-wrapper" id="result">
            </div>
        </div>
        <div class="search-box">
            <input type="search" name="search" id="search" placeholder="Search stuff...">
            <ul id="suggestion"></ul>
        </div>
        <?php if (isset($_SESSION['user'])) {
            echo '<div class="add">
                    <button class="btn icon" onclick="showModal()"><i class="fa-solid fa-plus"></i></button>
                </div>';
        } ?>
        <div class="modal">
            <form class="form-stuff" action="/data/add_product" method="POST" enctype="multipart/form-data">
                <i onclick="hideModal()" class="btn fa-solid fa-xmark"></i>
                <h1>Stuff</h1>
                <label for="nama-barang">Nama Barang</label>
                <input type="text" name="nama-barang" id="nama-barang" placeholder="Nama barang" required>
                <label for="berkas">Gambar Barang</label>
                <input type="file" name="berkas" id="berkas" accept="image/png, image/jpeg" required>
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" min="0" placeholder="Harga barang misal 5000.25" step=".01" required>
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" placeholder="Masukkan deskripsi barang" required></textarea>
                <input type="submit" name="submit" id="submit" value="Add Product">
            </form>
        </div>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/login.php') ?>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/footer.php') ?>

    <script src="script/script.js"></script>
    <script>
        document.getElementById('stuff').classList.add('active');

        var searchContainer = document.querySelector(".search-box");
        var searchBox = document.getElementById('search');
        var suggestion = document.getElementById('suggestion');

        searchBox.addEventListener('keyup', function(e) {
            if (e.key == "Enter" || e.key == "Escape") {
                suggestion.innerHTML = "";
                if (e.key == "Enter") {
                    searchStuff(searchBox.value)
                }
            } else {
                suggestStuff(searchBox.value);
            }

        })

        searchBox.addEventListener("focusin", function() {
            suggestStuff(searchBox.value);
            searchContainer.style.width = "30vw";
        })

        searchBox.addEventListener("focusout", function() {
            setTimeout(function() {
                suggestion.innerHTML = "";
                searchContainer.style.width = "15vw";
            }, 300);
        })
    </script>
</body>

</html>