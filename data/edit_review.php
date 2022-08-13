<?php 
session_start();
if (isset($_SESSION['username'])) {
    header("Location: index.php");
}
require 'connection.php';
$reviewId = $_GET['id'];
$movieId = $_GET['movieId'];

$sql = "SELECT * FROM review WHERE reviewId = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$reviewId]);
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
    <title>Edit Review - GryffHouse</title>
    <script src="https://kit.fontawesome.com/d4eb4a12db.js" crossorigin="anonymous"></script>
</head>
<body onload="themeLoader()">
    <?php include($_SERVER['DOCUMENT_ROOT'].'/components/header.php') ?>
    <main>
        <form class="form-review" action="/data/edit_review_action" method="POST">
            <h1>Review</h1>
            <input type="hidden" name="reviewId" id="reviewId" value="<?php echo $reviewId ?>">
            <input type="hidden" name="movieId" value="<?php echo $movieId ?>">
            <label for="rate">Rate</label>
            <input type="number" value="<?php echo $stmt['rate'] ?>" name="rate" id="rate" min="1" max="5" placeholder="Rate 1 - 5" required>
            <label for="review">Review</label>
            <textarea name="review" id="review" placeholder="Masukkan review Anda"><?php echo $stmt['review'] ?></textarea>
            <input type="submit" name="submit" id="submit" value="Edit Review">
        </form>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/components/footer.php') ?>

    <script src="/script/script.js"></script>
</body>
</html>