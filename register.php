<?php
require_once "includes/header.php";
// Проверка на совпадение данных при регистрации
$check_preregister = function ($name, $email, $password, $password_copy, $link): string {
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
    } elseif ($password != $password_copy) {
        //Пароль не совпадает
        return "Error_Password";
    } elseif ($lambda($sql, $name, $email)) {
        return "Good";
    }
};
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$password_copy = $_POST['password-copy'];
if (isset(
    $name,
    $email,
    $password,
    $password_copy,
)) {
    $check = $check_preregister($name, $email, $password, $password_copy, $link);
    if ($check == "Good") {
        $query = "insert into User (Name, Email, Phone, Password) values ('$name',
    '$email', '$phone', '$password')";
        $sql = mysqli_query($link, $query);
        if ($sql) {
            session_start();
            $_SESSION['name'] = $name;
            goHome();
        } else {
            echo "Ошибка: " . mysqli_error($link);
            die(0);
        }
    }
    if ($check == "Error_Password") {
        echo '<p class="red-color">Пароли не совпадают </p>';
    } elseif ($check == "User_Bad") {
        echo '<p class="red-color">Такой пользователь уже существует</p>';
    }
}
?>

<section class="section-login">
  <h1>Регистрация</h1>
  <form method="post">
    <div class="form-group">
      <label for="exampleInputEmail1">Ваше имя</label>
      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Ваша почта</label>
      <input type="email" class="form-control" id="exampleInputPassword1" name="email">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Ваш номер телефона</label>
      <input type="text" class="form-control" id="exampleInputPassword1" name="phone">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Ваш пароль</label>
      <input type="password" class="form-control" id="exampleInputPassword1" name="password">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Повторите пароль</label>
      <input type="password" class="form-control" id="exampleInputPassword1" name="password-copy">
    </div>
    <div class="register-padding-top">
      <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
    </div>
  </form>
</section>
