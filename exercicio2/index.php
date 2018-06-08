<?php

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header("Location: http://www.google.com");
    exit();
} elseif (isset($_COOKIE['loggedin']) && $_COOKIE['loggedin'] == true) {
    header("Location: http://www.google.com");
    exit();
}
