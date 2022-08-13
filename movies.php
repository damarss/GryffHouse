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
    <title>Movies - GryffHouse</title>
    <script src="https://kit.fontawesome.com/d4eb4a12db.js" crossorigin="anonymous"></script>
</head>

<body onload="themeLoader(); loadMovies()">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/header.php') ?>
    <main>
        <h1 style="text-align: center;margin: 10px">Movies</h1>
        <div class="search-box">
            <input type="search" name="search" id="search" placeholder="Search movies...">
            <ul id="suggestion"></ul>
        </div>
        <div class="card-wrapper" id="result">
        </div>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/login.php') ?>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/footer.php') ?>

    <script src="script/script.js"></script>
    <script>
        document.getElementById('movies').classList.add('active');

        var searchContainer = document.querySelector(".search-box");
        var searchBox = document.getElementById('search');
        var suggestion = document.getElementById('suggestion');

        searchBox.addEventListener('keyup', function(e) {
            if (e.key == "Enter" || e.key == "Escape") {
                suggestion.innerHTML = "";
                if (e.key == "Enter") {
                    searchMovies(searchBox.value);
                }
            } else {
                suggestMovies(searchBox.value);
            }

        })

        searchBox.addEventListener("focusin", function() {
            suggestMovies(searchBox.value);
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