#!/usr/bin/env python3
import argparse

parser = argparse.ArgumentParser()
parser.add_argument("NameCar", type=str)
parser.add_argument("Price", type=str)

args = parser.parse_args()

NameCar = args.NameCar
Price = args.Price
#NameFile = args.NameFile

text = f"""
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/header.php");
$sql = mysqli_query($link,
"select * from Full_Car where Name_Car = '{NameCar}' and Price = {Price}");
$row = mysqli_fetch_array($sql);
$name = $row["Name_Car"];
$year = $row["Year"];
$litr = $row["Litr"];
$max_speed = $row["Max_Speed"];
$color = $row["Color"];
$price = $row["Price"];
$image = "/" . $row["Image"];

$_SESSION['NameCar'] = $name;
$_SESSION['PriceCar'] = $price;
?>
<title>{NameCar}</title>
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
                <a type="submit" href="/bronirovanie.php" class="btn btn-dark">Забронировать</a>
                </form>
        </div>
    </div>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") setcookie("NameCar", $_SERVER['DOCUMENT_ROOT'] . "/bronirovanie.php", time()+200, $name);
require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php");
?>
"""

#with open(NameFile + ".php", "w") as file:
#    file.write(text)
print(text)
