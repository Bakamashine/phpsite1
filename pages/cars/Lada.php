
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/header.php");
$sql = mysqli_query($link,
"select * from Full_Car where Name_Car = 'Cruiser' and Price = 50000");
$row = mysqli_fetch_array($sql);
$name = $row["Name_Car"];
$year = $row["Year"];
$litr = $row["Litr"];
$max_speed = $row["Max_Speed"];
$color = $row["Color"];
$price = $row["Price"];
$image = "/" . $row["Image"];
?>
<title>Cruiser</title>
<div class="section-1-shablons flex">
    <div class="section-1-light-margin-left">
        <img alt="" src="<?=$image?>" class="section-1-img" />
    </div>
    <div class="section-1-start">
        <h1 class="section-1-shablons-h1"><?=$name?></h1>
        <p>Год выпуска: <?=$year?> год</p>
        <p>Максимальная скорость: <?=$max_speed?> км/ч</p>
        <p>Цвет: <?=$color?></p>
        <p>Цена: <?=$price?></p>
        <p>Номинальная ёмкость: <?=$litr?></p>
        <div class="flex-center section-1-shablons-padding-top">
                <from method="post" action="<?=$_SERVER['DOCUMENT_ROOT'] . "/bronirovanie.php"?>">
                <a type="submit" href="" class="btn btn-dark">Забронировать</a>
                </form>
        </div>
    </div>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") setcookie("NameCar", $_SERVER['DOCUMENT_ROOT'] . "/bronirovanie.php", time()+200, $name);
require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php");
?>

