
<?php
include "./script.php";
require_once ("header.php");
$sql = mysqli_query($link,
"select * from Full_Car where Name_Car = 'Seberal' and Price = 40000");
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
<title>Seberal</title>
<div class="section-1-shablons flex">
    <div class="section-1-light-margin-left">
        <img alt="" src="<?=$dir_site . $image?>" class="section-1-img" />
    </div>
    <div class="section-1-start">
        <h1 class="section-1-shablons-h1"><?=$name?></h1>
        <p>��� �������: <?=$year?> ���</p>
        <p>������������ ��������: <?=$max_speed?> ��/�</p>
        <p>����: <?=$color?></p>
        <p>����: <?=$price?></p>
        <p>����������� �������: <?=$litr?></p>
        <div class="flex-center section-1-shablons-padding-top">
                <a type="submit" href="<?= $dir_name . 'bronirovanie.php' ?>" class="btn btn-dark">�������������</a>
        </div>
    </div>
</div>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php");
?>
