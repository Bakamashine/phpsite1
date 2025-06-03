<?php
require "includes/header.php";

$name = $_POST['name'];
$password = $_POST['password'];
if (isset($name, $password)) {
    $query = "select Name, Password, Email, Phone from User where Name = '$name' and Password ='$password'";
    $sql = mysqli_query($link, $query);
    $row = mysqli_fetch_array($sql);
    if ($name != $row['Name'] and $password != $row['Password']) {
        echo '<p class="red-color">Такого пользователя не существует или пароль не верен</p>';
    }
    if ($name == $row['Name'] and $password == $row['Password']) {
        session_start();
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $row['Email'];
        $_SESSION['phone'] = $row['Phone'];
        goHome();
    }
}
?>
<!doctype html>
<title>Регистрация</title>


<section class="section-login">
  <h1>Авторизация</h1>
  <h1>Введите пожалуйста данные: </h1>
  <form method="post">
    <div class="form-group">
      <label for="exampleInputEmail1">Введите ваше имя</label>
      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Введите пароль</label>
      <input type="password" class="form-control" id="exampleInputPassword1" name="password">
    </div>
    <div class="register-padding-top">
      <button type="submit" class="btn btn-primary">Авторизироваться</button>
    </div>
  </form>
</section>

</html>
