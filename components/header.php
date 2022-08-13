<header>
    <a href="/index.php">
        <div class="logo">
            <div class="logo-img"></div>
            <h1>GryffHouse</h1>
        </div>
    </a>
    <nav>
        <!-- untuk mobile -->
        <div class="menu-btn" onclick="menu()">
            <span class="menu-bar"></span>
        </div>
        <ul>
            <li><a href="/index.php" id="home"><i class="fa-solid fa-house"></i> Home</a></li>
            <li><a href="/movies.php" id="movies"><i class="fa-solid fa-clapperboard"></i> Movies</a></li>
            <li><a href="/stuff.php" id="stuff"><i class="fa-solid fa-broom"></i> Stuff</a></li>
        </ul>
        <?php 
        if (isset($_SESSION['user'])) {
            include($_SERVER['DOCUMENT_ROOT'].'/components/btn-wrapper-logged-in.php'); 
        } else {
            include($_SERVER['DOCUMENT_ROOT'].'/components/btn-wrapper.php');
        }
        ?>
    </nav>
</header>