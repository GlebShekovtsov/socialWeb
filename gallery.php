<?php
session_start();
$conn = mysqli_connect("localhost", "root", "root", "socialwebdb");
$userid = $_SESSION['userid'];

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/GalleryPageStyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <title>Картинки</title>
</head>

<body>
    <div class="galleryContainer">
        <div class="menu">
            <div class="logo">
                <h1>DырNet</h1>
            </div>
        </div>
        <div class="leftMenu">
            <div class="widget">
                <ul class="grid">
                    <li><a href="userpage.php">Моя страница</a></li>
                    <li><a href="messages.php">Сообщения</a></li>
                    <li><a href="friends.php">Друзья</a></li>
                    <li><a href="gallery.php">Фотографии</a></li>
                    <li><a href="exit.php">Выход</a></li>
                </ul>
            </div>
        </div>
        <div class="gridgallery">
            <?php

            if (isset($_GET['id'])) {
                $picid = $_GET['id'];
                $galleryIDSelection = "SELECT * FROM `gallery` WHERE id = '$picid'";
                $galleryIDSelectionResult = mysqli_query($conn, $galleryIDSelection);
                foreach ($galleryIDSelectionResult as $galleryIdRow) {
                    echo "
                <figure class='gallery__item'>" .
                        "<a href='gallery.php?id=" . $galleryIdRow['id'] . "'>" . "<img src='img/" . $galleryIdRow['image'] . "' class='gallery__img' alt='Картинка'>" . "</a>" .
                        "<form class='descform' method='POST'>" .
                        "<input type='input' class='btn' name='description' value='" . $galleryIdRow['description'] . "'>
                            <input type='submit' class='btn' name='descsumbit'>" .
                        "</form>";
                }
            ?>
            <?php 
            if(isset($_POST['descsumbit'])){
                $desc = $_POST['description'];
                $descUpdate = "UPDATE `gallery` SET `description` = '$desc' WHERE id = '$picid'";
                if ($conn->query($descUpdate)) {
                    echo "<p>Описание изменено</p>";
                } else {
                    echo "<p> Ошибка: " . $conn->error . "</p>";
                }
            }
            ?>
            <?php
            } else if(!isset($_GET['id'])) {
                $gallerySelection = "SELECT * FROM `gallery` WHERE userId = '$userid'";
                $gallerySelectionResult = mysqli_query($conn, $gallerySelection);
                foreach ($gallerySelectionResult as $galleryRow) {
                    echo "
                <figure class='gallery__item'>" .
                        "<a href='gallery.php?id=" . $galleryRow['id'] . "'>" . "<img src='img/" . $galleryRow['image'] . "' class='gallery__img' alt='Картинка'>" . "</a>" .
                        "<figcaption class='picture1caption'>" . $galleryRow['description'] . "</figcaption>"
                        . "</figure>";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>