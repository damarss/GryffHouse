<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
}

$id = $_SESSION['user']['id'];

require $_SERVER['DOCUMENT_ROOT']."/data/connection.php";

$sql = "SELECT m.title, r.* FROM movie m, review r, user u 
        WHERE u.id = '$id' AND u.id = r.userId AND r.movieId = m.movieId ORDER BY r.tanggal DESC";

if ($_SESSION['user']['username'] == "admin") {
    $sql = "SELECT m.title, r.*, u.name FROM movie m, review r, user u 
    WHERE r.movieId = m.movieId AND u.id = r.userId
    ORDER BY r.tanggal DESC";
}

$stmt = $pdo->query($sql);
$stmt = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="stylesheet" href="/style/style.css">
    <link id="theme" rel="stylesheet" href="#">
    <link rel="stylesheet" href="/style/responsive.css">
    <title>Review - GryffHouse</title>
    <script src="https://kit.fontawesome.com/d4eb4a12db.js" crossorigin="anonymous"></script>
</head>
<body onload="themeLoader()">
    <?php include($_SERVER['DOCUMENT_ROOT'].'/components/header.php') ?>
    <main>
        <div class="profile-container">
            <?php include($_SERVER['DOCUMENT_ROOT'].'/components/sidebar-profile.php'); ?>
            <div class="content">
                <h1>Your Review</h1>
                <table class="user-review">
                    <tr>
                        <?php if ($_SESSION['user']['username'] == "admin") {
                            echo '<th>User</th>';
                        } ?>
                        <th>Film</th>
                        <th>Review</th>
                        <th>Rating</th>
                        <th>Action</th>
                    </tr>
                <?php foreach($stmt as $row) { ?>
                    <tr>
                        <?php if ($_SESSION['user']['username'] == "admin") {
                            echo '<td>' . $row['name'] . '</td>';
                        } ?>
                        <td><?php echo $row['title']; ?></td>
                        <td style="text-align: justify;"><?php echo $row['review']; ?></td>
                        <td><?php echo $row['rate']; ?></td>
                        <td>
                        <div class="action">
                            <?php
                                echo '<a class="btn" href="/data/edit_review.php?id=' . $row['reviewId'] . '&movieId='. $row['movieId']. '"><i class="fas fa-edit"></i> Edit</a>';
                                echo '<a class="btn cons" href="#" onclick="hapusReview('.$row['reviewId'].', '.$row['movieId'].')"><i class="fa-solid fa-trash-can"></i> Hapus</a> ';
                            ?>
                        </div>
                        </td>
                    </tr>
                <?php } ?>
                </table>
            </div>
        </div>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/components/footer.php'); ?>

    <script src="/script/script.js"></script>
    <script>
        document.getElementById('review').classList.add('active');
    </script>
</body>
</html>