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
    <style>
        main {
            padding: 10px 10rem;
        }

        .add {
            margin-right: -6em;
        }
    </style>
</head>

<body onload="themeLoader();">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/header.php') ?>
    <main>
        <h1 style="text-align: center;margin: 10px">Movies</h1>
        <?php

        require $_SERVER["DOCUMENT_ROOT"] . "/data/connection.php";

        $movieId = $_GET['id'];
        $sql = "SELECT m.*, r.review, AVG(r.rate) as rate FROM movie m 
                LEFT JOIN review r ON m.movieId = r.movieId
                WHERE m.movieId = '$movieId'
                GROUP BY m.title ORDER BY m.year;";
        $stmt = $pdo->query($sql);

        $movie = $stmt->fetch();

        $sql = "SELECT r.*, u.name FROM review r 
                RIGHT JOIN user u ON r.userId = u.id
                WHERE r.movieId = '$movieId' ORDER BY tanggal DESC, reviewId DESC;";

        $stmt = $pdo->query($sql);
        $review = $stmt->fetchAll();

        $notReviewed = true;
        if (isset($_SESSION['user'])) {
            for ($i = 0; $i < count($review); $i++) {
                if ($review[$i]['userId'] == $_SESSION['user']['id']) {
                    $notReviewed = false;
                    break;
                }
            }
        }

        ?>
        <a class="btn" href="/movies.php">Kembali</a>
        <div class="movie-detail">
            <div class="movie-detail-info">
                <div class="movie-detail-title"><?php echo $movie['title'] ?></div>
                <div class="movie-detail-img"><img src="<?php echo $movie["image_url"] ?>" alt="<?php $movie["title"] ?>"></div>
                <p><i style="color: red; padding-right: 15px;" class="fa-solid fa-calendar"></i> <?php echo $movie['year'] ?></p>
                <p><i style="color: gold; padding-right: 15px;" class="fa-solid fa-star"></i> <?php echo round($movie['rate'], 1) ?></p>
            </div>
            <div class="movie-detail-synopsis">
                <?php echo $movie['synopsis'] ?>
            </div>
            <div class="review" id="review-container">
                <h2>Review</h2>
                <?php 
                if (empty($_SESSION['user'])) {
                    echo '<small>Silakan <a href="#login-form" onclick="showLogin()">login</a> terlebih dahulu untuk menambahkan review</small>';
                }

                for ($i = 0; $i < count($review); $i++) { ?>
                    <div class="review-item">
                        <div class="review-info">
                            <div class="review-item-user"><?php echo $review[$i]['name'] ?></div>
                            <div class="review-item-date"><?php echo $review[$i]['tanggal'] ?></div>
                        </div>
                        <div class="review-item-rate"><img src="/img/star.png" alt="star"> <?php echo round($review[$i]['rate'],1) ?>/5</div>
                        <div class="review-item-review"><?php echo $review[$i]['review']; ?></div>
                        <div class="action">
                            <?php
                                if (isset($_SESSION['user'])) {
                                    if ($review[$i]['userId'] == $_SESSION['user']['id'] || $_SESSION['user']['username'] == 'admin') {
                                        echo '<a href="/data/edit_review.php?id=' . $review[$i]['reviewId'] . '&movieId='. $review[$i]['movieId']. '">Edit</a>';
                                        echo '<a href="#review-container" onclick="hapusReview(' . $review[$i]['reviewId'] .', ' . $review[$i]['movieId'] . ')">Hapus</a> ';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php if (isset($_SESSION['user']) && $notReviewed) {
            echo '<div class="add">
                    <button class="btn icon" onclick="showModal()"><i class="fa-solid fa-plus"></i></button>
                </div>';
        } ?>
        <div class="modal">
            <form class="form-review" action="/data/add_review" method="POST">
                <i onclick="hideModal()" class="btn fa-solid fa-xmark"></i>
                <h1>Review</h1>
                <input type="hidden" name="movieId" value="<?php echo $movieId ?>">
                <label for="rate">Rate</label>
                <input type="number" name="rate" id="rate" min="1" max="5" placeholder="Rate 1 - 5" required>
                <label for="review">Review</label>
                <textarea name="review" id="review" placeholder="Masukkan review Anda"></textarea>
                <input type="submit" name="submit" id="submit" value="Submit Review">
            </form>
        </div>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/components/login.php') ?>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/footer.php') ?>

    <script src="script/script.js"></script>
    <script>
        document.getElementById('movies').classList.add('active');
    </script>
</body>

</html>