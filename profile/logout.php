<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: /");
}
session_unset();
session_destroy();
header("Location: /");
?>