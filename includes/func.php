<?php

// Check user
function Check_auth(): bool
{
    return isset($_SESSION['name']);
}
// Return index.php
function goHome(): void
{
    header("Location: ./index.php");
}
// Выход из сессии
function logout(): void
{
    if (!Check_auth()) {
        session_start();
        unset($_SESSION['name']);
        session_destroy();
        header("Location: ./index.php");
    }
}
// Авторизация
function login($link, $name, $password): string
{
    $query = "SELECT Name, Password FROM User WHERE Name = '$name' AND Password = '$password'";
    $sql = mysqli_query($link, $query);
    if ($sql) {
        return $name;
    } else {
        return "Авторизация прошла безуспешно!";
    }
}

// Проверка на совпадение данных при регистрации
function check_preregister($name, $email, $password, $password_copy, $link)
{
    $query = "select Name, Email from User where Name = '$name' or Email = '$email'";
    $sql = mysqli_query($link, $query);
    $lambda = function ($sql, $name, $email): bool {
        while ($row = mysqli_fetch_array($sql)) {
            $name2 = $row["Name"];
            $email2 = $row["Email"];
            if ($email == $email2 or $name == $name2) {
                return false;
            }
        }
        return true;
    };

    if (!$lambda($sql, $name, $email)) {
        // Имя или почта пользователя уже есть в БД
        return "User_Bad";
    }
    if ($password != $password_copy) {
        //Пароль не совпадает
        return "Error_Password";
    }
    if ($lambda($sql, $name, $email)) {
        return "Good";
    }
}

// Поиск машин в БД
function search_cars($name, $city, $marks, $price_min, $price_max)
{
    if (empty($name)) {
        $name = "%";
    }
    if (empty($city)) {
        $city = "%";
    }
    if (empty($marks)) {
        $marks = "%";
    }
    if (empty($price_min)) {
        $price_min = 0;
    }
    if (empty($price_max)) {
        $price_max = 1000000000;
    }
    $query = "select id, Name, City, Price, Image, Marks, File from Car where
(Name Like '$name') and
(City Like '$city') and
(Marks Like '$marks') and
(Price > $price_min and Price < $price_max) and
(File Like '%')";
    return $query;
}

// function count_zap($link): int
// {
//     $query = "select count(*) from Car";
//     $sql = mysqli_query($link, $query);
//     $row = mysqli_fetch_array($sql);
//     $count = $row[0];
//     $count = intval($count[0]);
//     return $count;
// }
function random_three_int($count): array
{
    $arr = array();
    $i = 0;
    while (true) {
        $ran = mt_rand(1, $count);
        if ($i >= 3) {
            break;
        } elseif (in_array($ran, $arr)) {
            continue;
        } elseif (!in_array($ran, $arr)) {
            array_push($arr, $ran);
            $i += 1;
        }
    }
    return $arr;
}
