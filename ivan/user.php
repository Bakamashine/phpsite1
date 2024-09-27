<?php
require_once "includes/header.php";

$name = $_SESSION['name'];
$email = $_SESSION['email'];
$query = "select Name_Car, Price_Car from Bron 
where  Name_Bron = '$name' 
and Email_Bron = '$email'";
$sql = mysqli_query($link, $query);
$i = 0;
?>
<h1 class="text-center otstup-button">Мои заявки</h1>
<section class="section-1-user">
  <?php if (mysqli_fetch_array($sql)[0] == null or !$sql): ?>
    <h4 class="text-center">У вас нет никаких заявок</h4>
  <?php else: ?>
    <table class="table table-user">
      <thead>
        <tr>
          <th scope="col">№</th>
          <th scope="col">Имя машины</th>
          <th scope="col">Цена машины</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($row = mysqli_fetch_array($sql)) { // Получения записей
          // $Name_Bron = $row['Name_Bron'];               // Имя забронировавшего
          // $Email_Bron = $row['Email_Bron'];             // Почта забронировавшего
          // $Phone_Bron = $row['Phone_Bron'];             // Телефон забронировавшего
          $Name_Car = $row['Name_Car'];                 // Имя машины
          $Price_Car = $row['Price_Car'];               // Цена аренды
          $i += 1;
        ?>
          <tr>
            <td class="td-user"><?= $i ?></td>
            <td class="td-user"><?= $Name_Car ?></td>
            <td class="td-user"><?= $Price_Car ?></td>
          </tr>
        <?php } ?>
    </table>
  <?php endif; ?>
</section>
<?php
require "includes/footer.php";
?>
