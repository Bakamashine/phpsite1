<?php
require_once "includes/header.php";

// Класс по созданию индивидуального файла
class Create
{
  public string $name;
  public string $price;
  public string $file;
  public string $file_name;
  public function __construct($name, $price, $file, $file_name)
  {
    $this->name = $name;
    $this->price = $price;
    $this->file = $file;
    $this->file_name = $file_name;
  }
  // Создание индвивидуального файла
  public function Create_individual_file(): bool
  {
    // $script = "python pages/cars/main.py " . $this->name . " " . $this->price;
    $script = "pages/cars/main " . $this->name . " " . $this->price;
    $new_file = popen($script, "r");
    $text = fread($new_file, 2096);
    $create_file = fopen($this->file, "w");
    fwrite($create_file, $text);
    if (is_file($this->file) and fopen($this->file, "r") != false) {
      return true;
    } else {
      return false;
    }
  }
  // Создание запросов
  public static function Mega_Query(
    $name,
    $city,
    $price,
    $image,
    $marks,
    $file,
    $year,
    $litr,
    $max_speed,
    $color,
    $link
  ): bool {
    $query = "INSERT INTO Car (Name, City, Price, Image, Marks, File) VALUES ('$name', '$city', '$price', '$image', '$marks', '$file')"; // Если есть, то начинается запрос на дополнение
    $sql1 = mysqli_query($link, $query); // Отправление первого запроса
    $query = "INSERT INTO Full_Car (Name_Car, Year, Litr, Max_Speed, Color, Price, Image) values ('$name', '$year', '$litr', '$max_speed', '$color', '$price', '$image')";
    $sql2 = mysqli_query($link, $query); //Отправление второго запроса
    if ($sql1 and $sql2) {
      return true;
    } else {
      return false;
    }
  }
  public static function count_zap($link)
  {
    $query = "select count(*) from Car";
    $sql = mysqli_query($link, $query);
    $row = mysqli_fetch_array($sql);
    $count = $row[0];
    $count = intval($count[0]);
    return $count;
  }
}

// Все переменные с БД
$name = $_POST['name'];         // Имя машины
$city = $_POST['city'];         // Город машины
$price = $_POST['price'];       // Цена аренды
$image =  "img/carusel/" . $_POST['image'];      // Ссылка на картинку машины (путь)
$marks =  $_POST['marks'];      // Марка машины
$year = $_POST['year'];         // Год производства машины
$max_speed = $_POST['max_speed']; // Максимальная скорость
$litr = $_POST['litr'];            // Максимальная вместимость бензина
$color = $_POST['color'];         // Цвет машины
$file_id = Create::count_zap($link) + 1;
$file_name = "$marks" . $file_id;            // Ссылка на марку машины (Чтобы задать имя файла)
$file = "pages/cars/$file_name.php"; // Путь к файлу от домашней директории проекта

// print("name: " . $name);
// echo "<br>";
// print("city: " . $city);
// echo "<br>";
// print("price: " . $price);
// echo "<br>";
// print("image: " . $image);
// echo "<br>";
// print("marks: " . $marks);
// echo "<br>";
// print("year: " . $year);
// echo "<br>";
// print("max_speed: " . $max_speed);
// echo "<br>";
// print("litr: " . $litr);
// echo "<br>";
// print("color: " . $color);
// echo "<br>";
// print("file: " . $file);
// echo "<br>";
// print("file_name: " . $file_name);

if (isset($name, $city, $price, $image, $marks, $year, $max_speed, $litr, $color, $file)) { // Если пусто, то не пропускает дальше
  $create = new Create($name, $price, $file, $file_name);
  if ($create->Create_individual_file()) {
    if (Create::Mega_Query($name, $city, $price, $image, $marks, $file, $year, $litr, $max_speed, $color, $link)) {                         // Проверка на правильность отправления запроса
      echo "<p class='form-padding-admin'>Отдельный файл для созданной машины был
  создан в папке $file</p>";
    }
  } else {                      // Или...
    echo ("Отдельный файл $file_name не был создан. Ошибка: ");
  }
}
?>
<h1 class="register-h1">Создание новой записи</h1>
<div class="form-size-admin center">
  <form method="post">
    <div class="input-group flex-nowrap form-padding-admin">
      <span class="input-group-text input-group-text-dop" id="addon-wrapping">Введите название машины</span>
      <input type="text" class="form-control" aria-label=""
        aria-describedby="addon-wrapping"
        name="name">
    </div>
    <div class="input-group flex-nowrap form-padding-admin">
      <span class="input-group-text input-group-text-dop" id="addon-wrapping">Введите город</span>
      <input type="text" class="form-control" aria-label=""
        aria-describedby="addon-wrapping" name="city">
    </div>
    <div class="input-group flex-nowrap form-padding-admin">
      <span class="input-group-text input-group-text-dop" id="addon-wrapping">Введите цену</span>
      <input type="text" class="form-control" aria-label=""
        aria-describedby="addon-wrapping"
        name="price">
    </div>
    <div class="input-group flex-nowrap form-padding-admin">
      <span class="input-group-text input-group-text-dop" id="addon-wrapping">Введите марку машины</span>
      <input type="text" class="form-control" aria-label=""
        aria-describedby="addon-wrapping" name="marks">
    </div>

    <div class="input-group flex-nowrap form-padding-admin">
      <span class="input-group-text input-group-text-dop" id="addon-wrapping">Введите год производства машины</span>
      <input type="text" class="form-control" aria-label=""
        aria-describedby="addon-wrapping" name="year">
    </div>

    <div class="input-group flex-nowrap form-padding-admin">
      <span class="input-group-text input-group-text-dop" id="addon-wrapping">Введите максимальную скорость машины</span>
      <input type="text" class="form-control" aria-label=""
        aria-describedby="addon-wrapping" name="max_speed">
    </div>

    <div class="input-group flex-nowrap form-padding-admin">
      <span class="input-group-text input-group-text-dop" id="addon-wrapping">Введите максимальную вместимость (в литрах)</span>
      <input type="text" class="form-control" aria-label=""
        aria-describedby="addon-wrapping" name="litr">
    </div>

    <div class="input-group flex-nowrap form-padding-admin">
      <span class="input-group-text input-group-text-dop" id="addon-wrapping">Введите цвет</span>
      <input type="text" class="form-control" aria-label=""
        aria-describedby="addon-wrapping" name="color">
    </div>

    <div class="input-group flex-nowrap form-padding-admin form-padding-bottom-admin">
      <input type="file" class="form-control" aria-label="Image"
        aria-describedby="addon-wrapping" value="" accept="*.jpg, *.png, *.jpeg"
        name="image">
    </div>

    <input class="btn btn-dark" type="submit" value="Выложить">
  </form>
</div>

<?php
$query = "select Name_Bron, Email_Bron, Phone_Bron, Name_Car, Price_Car  from Bron"; // Выборка записей для таблицы
$sql = mysqli_query($link, $query); // Отправление запроса
?>
<div class="bronirovavshie">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">№</th>
        <th scope="col">Имя бронировавшего</th>
        <th scope="col">Почта бронировавшего</th>
        <th scope="col">Телефон бронировавшего</th>
        <th scope="col">Название машины</th>
        <th scope="col">Цена бронирования</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_array($sql)) { // Получения записей
        $Name_Bron = $row['Name_Bron'];               // Имя забронировавшего
        $Email_Bron = $row['Email_Bron'];             // Почта забронировавшего
        $Phone_Bron = $row['Phone_Bron'];             // Телефон забронировавшего
        $Name_Car = $row['Name_Car'];                 // Имя машины
        $Price_Car = $row['Price_Car'];               // Цена аренды
      ?>
        <tr>
          <th scope="row">1</th>
          <td><?= $Name_Bron ?></td>
          <td><?= $Email_Bron ?></td>
          <td><?= $Phone_Bron ?></td>
          <td><?= $Name_Car ?></td>
          <td><?= $Price_Car ?></td>
        </tr>
      <?php } ?>
  </table>
</div>
<?php
require_once "includes/footer.php";
?>
