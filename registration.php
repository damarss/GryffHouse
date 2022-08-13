<!DOCTYPE html>
<?php 
session_start();
if (isset($_SESSION['username'])) {
    header("Location: index.php");
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="/style/style.css">
    <link id="theme" rel="stylesheet" href="#">
    <link rel="stylesheet" href="/style/responsive.css">
    <title>Registration - GryffHouse</title>
    <script src="https://kit.fontawesome.com/d4eb4a12db.js" crossorigin="anonymous"></script>
</head>
<body onload="themeLoader()">
    <?php include($_SERVER['DOCUMENT_ROOT'].'/components/header.php') ?>
    <main>
        <form onsubmit="validationRegistration()" name="regis-form" id="regis-form" method="POST" action="/data/registration_action" autocomplete="off">
            <h1>Registration</h1>
            <label id="name-label" for="name">*Name must be filled</label>
            <input type="text" id="name" name="name" onkeyup="validateName()" placeholder="Enter your name" required>
            <label id="email-label" for="email">*Email must be filled</label>
            <input type="email" id="email" name="email" placeholder="Enter your email address" required>
            <label id="phone-label" for="phone">*Phone must be filled</label>
            <input type="text" name="phone" id="phone" onkeyup="validatePhone()" placeholder="Enter your phone number" required>
            <label id="favhouse-label" for="favhouse">Pick Your Favorite House</label>
            <select name="favhouse" id="favhouse" required>
                <option value="" disabled selected>-- Select Your Favorite House --</option>
                <option value="Gryffindor">Gryffindor</option>
                <option value="Slytherin">Slytherin</option>
                <option value="Ravenclaw">Ravenclaw</option>
                <option value="Hufflepuff">Hufflepuff</option>
            </select>
            <label id="usrnm-label" for="usrnm">*Username must be filled</label>
            <input type="text" name="usrnm" id="usrnm" onkeyup="validateUsername()" placeholder="Enter your username" required>
            <label id="pwd-label" for="pwd">*Password must be filled</label>
            <input type="text" name="pwd" id="pwd" onkeyup="validatePassword()" placeholder="Enter your password" required>
            <label id="pwd-confirm-label" for="pwd-confirm">*Confirm password</label>
            <input type="text" name="pwd-confirm" id="pwd-confirm" onkeyup="validatePasswordConfirm()" placeholder="Password must be same" required>
            <input type="submit" value="Register">
        </form>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/components/login.php') ?>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/components/footer.php') ?>

    <script src="script/script.js"></script>
</body>
</html>