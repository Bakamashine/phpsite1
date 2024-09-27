<?php
require "includes/header.php";
require_once "includes/func.php";
?>
<h1 class="text-center section-1-h1">Аренда авто в России</h1>

<!-- Carusel -->
<section class="section-1">
    <div id="carouselExampleDark" class="carousel carousel-dark slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner carusel-okruglenie ">
<?php
            $query = "select count(*) from Car";
            $sql = mysqli_query($link, $query);
            if ($sql) {
                $row = mysqli_fetch_all($sql);
                $count = $row[0];
                unset($row);
                $count = intval($count[0]);
                $random_arr = random_three_int($count);
                $query = "SELECT Name, City, Price, Image, File FROM Car WHERE `id`=" . $random_arr[2];
		$sql = mysqli_query($link, $query);
		$row = mysqli_fetch_array($sql);
	?>
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img src="<?= $row["Image"] ?>" class="d-block w-100 img-carusel" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class="pobelka"><?= $row["Name"] ?></h5>
                            <p class="pobelka">Город: <?= $row["City"] ?></p>
                            <p class="pobelka ">Цена: <?= $row["Price"] ?></p>
                            <?php if ($_SESSION['name'] != null and  $_SESSION['name'] != "admin"): ?>
                                <a class="btn btn-light" href="<?= $row['File'] ?>">Рассмотреть</a>
                            <?php elseif ($_SESSION['name'] == "admin"): ?>
                                <p class="pobelka">Вы администратор!</p>
                            <?php elseif ($_SESSION['name'] == null): ?>
                                <a class="btn btn-light" href="login.php">Требуется регистрация</a>
                            <?php endif; ?>
                        </div>
                    </div>
            <?php
		unset($row, $query, $sql);
                for ($i = 0; $i < 2; $i += 1) {
                    $query = "SELECT Name, City, Price, Image, File FROM Car WHERE `id`=" . $random_arr[$i];
                    $sql = mysqli_query($link, $query);
                    $arr = mysqli_fetch_array($sql);
                    $image = $arr['Image'];
                    $price = $arr['Price'];
                    $name = $arr['Name'];
                    $city = $arr['City'];
                    $file = $arr['File'];

                    // TODO: Происходит баг из-за лишнего .css свойства
            ?>
                    <div class="carousel-item " data-bs-interval="10000">
                        <img src="<?= $image ?>" class="d-block w-100 img-carusel" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class="pobelka"><?= $name ?></h5>
                            <p class="pobelka">Город: <?= $city ?></p>
                            <p class="pobelka ">Цена: <?= $price ?></p>
                            <?php if ($_SESSION['name'] != null and  $_SESSION['name'] != "admin"): ?>
                                <a class="btn btn-light" href="<?= $file ?>">Рассмотреть</a>
                            <?php elseif ($_SESSION['name'] == "admin"): ?>
                                <p class="pobelka">Вы администратор!</p>
                            <?php elseif ($_SESSION['name'] == null): ?>
                                <a class="btn btn-light" href="login.php">Требуется регистрация</a>
                            <?php endif; ?>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
<!-- End Carusel -->

<section class="section-2">
    <h1 class="text-center">Поиск машины</h1>
    <form action="" method="get">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Имя машины</span>
            </div>
            <input type="text" class="form-control" aria-label="name" aria-describedby="basic-addon1" name="name">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">Город</span>
            </div>
            <input type="text" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2" name="city">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Марка машины</span>
            </div>
            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="marks">
        </div>

        <div class="flex-center">
            <h6>Цена</h6>
        </div>
        <div class="input-group mb-3 flex">
            <div class="input-group-prepend">
                <span class="input-group-text">От</span>
            </div>
            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="price_min">

            <div class="input-group-prepend">
                <span class="input-group-text">До</span>
            </div>
            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="price_max">
        </div>
        <div class="flex-center">
            <button type="submit" class="btn btn-dark section-2-input-button">Поиск</button>
        </div>
    </form>
    <?php
    $name = $_GET['name'];
    $city = $_GET['city'];
    $marks = $_GET['marks'];
    $price_min = $_GET['price_min'];
    $price_max = $_GET['price_max'];

    $query = search_cars($name, $city, $marks, $price_min, $price_max);
    $sql = mysqli_query($link, $query);

    $lambda = function ($name, $city, $marks, $price_min, $price_max, $sql) {
        if ((isset($name) or isset($city) or isset($marks) or isset($price_min) or isset($price_max)) and $sql) {
            return true;
        }
        if (!isset($name, $city, $marks, $price_min, $price_max)) {
            return false;
        }
    };

    if ($lambda($name, $city, $marks, $price_min, $price_max, $sql)) {
        unset($name, $city, $marks,  $price_max, $price_min);
        echo '
<div>
<h1 class="section-1-warning text-center">Результаты: </h1>
</div>';
        echo '<div class="flex-center header-logo">';
        unset($name, $city, $marks, $price_max, $price_min);
        while ($row = mysqli_fetch_array($sql)) {
            $name = $row['Name'];
            $price = $row['Price'];
            $image = $row['Image'];
            $marks = $row['Marks'];
            $city = $row['City'];
            $file = $row['File'];
    ?>
            <div class="section-1-yacheika">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="<?= $image ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?= $name ?></h5>
                        <p class="card-text">Город: <?= $city ?></p>
                        <p class="card-text">Марка: <?= $marks ?></p>
                        <p class="card-text">Цена: <?= $price ?></p>
                        <?php if ($_SESSION['name'] != null and  $_SESSION['name'] != "admin"): ?>
                            <a class="btn btn-primary" href="<?= $file ?>">Рассмотреть</a>
                        <?php elseif ($_SESSION['name'] == "admin"): ?>
                            <p>Вы администратор!</p>
                        <?php elseif ($_SESSION['name'] == null): ?>
                            <a class="btn btn-primary" href="login.php">Требуется регистрация</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
    <?php
        }
    }

    if (!$lambda($name, $city, $marks, $price_min, $price_max, $sql)) {
        echo '<p class="text-center section-1-warning">Результатов нет</p>';
    }
    ?>
    </div>

</section>
<?php
require_once "includes/footer.php";
?>
