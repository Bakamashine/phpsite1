<?php
require_once "includes/header.php";
session_start();
$NameCar = $_SESSION['NameCar']; //TODO: Должно как-то присылаться название выбранной машины
$PriceCar = $_SESSION['PriceCar'];
var_dump($NameCar);
var_dump($PriceCar);
$NameUser = $_SESSION['name'];
$EmailUser = $_SESSION['email'];
$PhoneUser = $_SESSION['phone'];

if (isset($NameCar, $PriceCar, $NameUser, $EmailUser, $PhoneUser)) {
    $query = "insert into Bron (Name_Bron, Email_Bron, Phone_Bron, Name_Car, Price_Car) values ('$NameUser', '$EmailUser', '$PhoneUser' , '$NameCar', '$PriceCar')";
    $sql = mysqli_query($link, $query);
    if ($sql) {
        // echo "<p>Вы успешно подали заявку на бронирование автомобиля, в скором времени с вами свяжется администратор</p>";
        $text = "Вы успешно подали заявку на бронирование автомобиля, в скором времени с вами свяжется администратор";
        setcookie("result", $text, time() + 10, $_SERVER['DOCUMENT_ROOT'] . "/index.php");
        goHome();
    } else {
        $text = "Не получилось арендовать машину, возможно что это ошибка";
        setcookie("result", $text, time() + 10, $_SERVER['DOCUMENT_ROOT'] . "/index.php");
    }
}

?>
<title>Бронирование</title>
