<div class="btn-wrapper">
    <a class="btn icon" onclick="themeChanger()"><i class="fa-solid fa-circle-half-stroke"></i></a>
    <div class="profile-dropdown">
        <a class="btn profile-icon" href="/profile/profile.php"><i class="fa-solid fa-user"></i>
            <?php echo substr($_SESSION['user']['username'], 0, 10) ?></a>
        <ul>
            <li><a href="/profile/profile.php">Profile</a></li>
            <li><a href="/profile/review.php">Review</a></li>
            <li><a href="/profile/product.php">Product</a></li>
            <li><a href="/profile/logout.php">Logout</a></li>
        </ul>
    </div>
</div>