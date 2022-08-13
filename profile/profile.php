<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
}
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
    <title>Profile - GryffHouse</title>
    <script src="https://kit.fontawesome.com/d4eb4a12db.js" crossorigin="anonymous"></script>
</head>

<body onload="themeLoader()">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/header.php') ?>
    <main>
        <div class="profile-container">
            <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/sidebar-profile.php'); ?>
            <div class="content">
                <h1>User Profile</h1>
                <form class="editable" action="/data/edit_profile" method="POST">
                    <table class="user-profile">
                        <tr>
                            <th>Name</th>
                            <td><input type="text" name="name" id="name" value="<?php echo $_SESSION['user']['name']; ?>" required></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td><input type="text" name="username" id="username" value="<?php echo $_SESSION['user']['username']; ?>" required></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><input type="text" name="email" id="email" value="<?php echo $_SESSION['user']['email']; ?>" required></td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td><input type="text" name="phone" id="phone" value="<?php echo $_SESSION['user']['phone']; ?>" required></td>
                        </tr>
                        <tr>
                            <th>Favorite House</th>
                            <td><select name="favhouse" id="favhouse">
                                    <option value="" disabled selected>-- Select Your Favorite House --</option>
                                    <option value="Gryffindor">Gryffindor</option>
                                    <option value="Slytherin">Slytherin</option>
                                    <option value="Ravenclaw">Ravenclaw</option>
                                    <option value="Hufflepuff">Hufflepuff</option>
                                </select></td>
                        </tr>
                        <tr>
                            <th>Password Baru</th>
                            <td><input type="text" name="new-pass" id="new-pass"></td>
                        </tr>
                        <tr>
                            <td><button class="btn" type="submit">Edit Profil</button></td>
                        </tr>
                    </table>
                </form>

            </div>
        </div>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/footer.php'); ?>

    <script src="/script/script.js"></script>
    <script>
        document.getElementById('profile').classList.add('active');
        document.getElementById('favhouse').value = "<?php echo $_SESSION['user']['favhouse']; ?>";
    </script>
</body>

</html>