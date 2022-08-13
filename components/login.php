<div class="blur">
    <form class="login-form" name="login-form" method="POST" action="/data/login_action" autocomplete="off">
        <i onclick="hideLogin()" class="btn fa-solid fa-xmark"></i>
        <h1>Login</h1>
        <div id='errBox'></div>
        <input type="text" name="username" id="username" placeholder="Enter your username" required>
        <input type="password" name="password" id="password" placeholder="Enter your password" required>
        <input type="submit" value="Login">
        <p>Belum ada akun? <a href="registration.php">daftar disini</a></p>
        <img class="reveal-btn" onclick="revealPassword(this)" src="/img/reveal.png" alt="reveal button">
    </form>
    <?php

    if (isset($_GET['err'])) {
        echo "<script>document.querySelector('.blur').style.display = 'flex';</script>";
        if ($_GET['err'] == 1) {
            echo "<script>
                document.getElementById('errBox').innerHTML = '<p style=\"color: red\">Username atau password salah</p>';
            </script>";
        } else {
            echo "<script>
                document.getElementById('errBox').innerHTML = '<p> Silakan Login</p>';
            </script>";
        }
    }
    ?>
</div>