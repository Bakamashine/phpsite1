<?php
error_reporting(E_ERROR);
session_start();
require_once "func.php";
require "db.php";

global $link;
$link = connectDB();

$dir_site = "/" . basename(dirname(str_replace(" \\includes\\ ", "", __DIR__))) . "/"; // Cool kostil
?>
<!doctype html>
<html lang="ru">

<head>
    <link href="<?= $dir_site . 'css/main.css' ?>" rel="stylesheet" />
    <link href="<?= $dir_site . 'bootstrap/css/bootstrap-reboot.css' ?>" rel="stylesheet"/>
    <link href="<?= $dir_name . 'bootstrap/css/bootstrap.css' ?>" rel="stylesheet" />
    <meta charset="UTF-8" />
    <title>Эх, прокачу!</title>
</head>

<body>
    <!-- Шапка -->
    <header>
        <div class="header-nap flex">
            <div class="header-logo">
                <h1>Эх, прокачу!</h1>
            </div>
            <div class="header-center-knopki">
                <div class="flex-center-center">

                    <button class="header-knp" onclick="window.location.href='index.php'">Главная</button>
                    <?php
                    if (!Check_auth()) {
                        ?>
                        <button class="header-knp" onclick="window.location.href='register.php'">Регистрация</button>
                        <button class="header-knp" onclick="window.location.href='login.php'">Авторизация</button>
                    <?php
                    } else {
                        ?>
                        <button class="header-knp" onclick="window.location.href='exit.php'">Выход</button>
                        <?php
                            if ($_SESSION['name'] == "admin") {
                                ?>
                            <button class="header-knp" onclick="window.location.href='admin.php'">Admin</button>
                    <?php
                            }
                        if ($_SESSION['name'] != "admin") {
                            echo "<button class='header-knp' onclick=window.location.href='user.php'>Мой кабинет</button>";
                            echo "
                    <p class='header-name-user'>Вы авторизированы как: " . $_SESSION['name'] . " </p>";
                        }
                    }
?>
                </div>
            </div>
        </div>
    </header>

    <script src="<?= $dir_name . 'bootstrap/js/bootstrap.js' ?>"></script>
</body>
</html>
