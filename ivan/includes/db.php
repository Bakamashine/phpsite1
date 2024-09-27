<?php

function connectDB()
{
    global $connect;
    $user = "admin";
    $password = "admin";
    $db = "myfirstdb";
    $localhost = "localhost";
    $port = 3306;
    try {
        $connect = mysqli_connect($localhost, $user, $password, $db, $port);
    } catch (Exception $e) {
        echo "Connect Error!" . mysqli_connect_error();
    }
    return $connect;
}
