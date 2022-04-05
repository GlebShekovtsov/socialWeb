<?php
session_start();
$conn = mysqli_connect("localhost", "root", "root", "socialwebdb");
$userid = $_SESSION['userid'];
$friendselect = "SELECT * FROM `page` WHERE userId != '$userid'";
$friendselectresult = mysqli_query($conn, $friendselect);
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/FriendPageStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <title>Друзья</title>
</head>

<body>
    <div class="galleryContainer">
        <div class="menu">
            <div class="logo">
                <h1>DырNet </h1>
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
        <div class="content">
            <div class="search">
                <form class="searchform" method="POST">
                    <label for="">Поиск людей: </label>
                    <input type="text" class="searchbutt" name="searchstring">
                    <input type="submit" class="btn" name="searchsubmit">
                </form>
            </div>
            <div class="friensgrid">



                <?php
                if (isset($_POST['searchsubmit'])) {
                    $searchstring = $_POST['searchstring'];
                    $searchInsert = "SELECT * FROM `page` WHERE city = '$searchstring'";
                    $searchResult = mysqli_query($conn, $searchInsert);
                    foreach ($searchResult as $friendrow) {
                        echo "
                        <div class='friendline'>
                            <figure class='gallery__item'>
                                <img src='img/" . $friendrow['avatar'] . "' class='gallery__img' alt=''>
                            </figure>
                            "
                            .

                            "<div class='fullname'>
                                <h2>" . $friendrow['fullName'] . "</h2>
                            </div>
                            <div class='actionbuttons'>
                            <form class='descform'  action='friendpage.php' method='POST'>" .
                            "<input type='submit' class='btn' name='checkpage' value='Просмотреть страницу'>" .
                            "<input type='hidden' class='hiddenbtn' name='id' value='" . $friendrow["id"] . "'>" .
                            "<input type='hidden' class='hiddenbtn' name='userId' value='" . $friendrow["userId"] . "'>" .

                            "</form>
                            <form class='descform' method='POST'>" .
                            "<input type='hidden' class='hiddenbtn' name='id' value='" . $friendrow["id"] . "'>" .
                            "<input type='submit' class='btn' name='addfriend' value='Добавить в друзья'>" .
                            "</form>
                            </div>
                        </div>";
                        if (isset($_POST['addfriend'])) {
                            $pagefriendid = $_POST['id'];
                            $addfriend = "INSERT INTO `friend` (`idUser`, `idFriend`) VALUES ('$userid', '$pagefriendid')";
                            if ($conn->query($addfriend));
                        }
                    }
                } else {
                    foreach ($friendselectresult as $friendrow) {
                        echo "
                        <div class='friendline'>
                            <figure class='gallery__item'>
                                <img src='img/" . $friendrow['avatar'] . "' class='gallery__img' alt=''>
                            </figure>
                            "
                            .

                            "<div class='fullname'>
                                <h2>" . $friendrow['fullName'] . "</h2>
                            </div>
                            <div class='actionbuttons'>
                            <form class='descform'  action='friendpage.php' method='POST'>" .
                            "<input type='submit' class='btn' name='checkpage' value='Просмотреть страницу'>" .
                            "<input type='hidden' class='hiddenbtn' name='id' value='" . $friendrow["id"] . "'>" .
                            "<input type='hidden' class='hiddenbtn' name='userId' value='" . $friendrow["userId"] . "'>" .

                            "</form>
                            <form class='descform' method='POST'>" .
                            "<input type='hidden' class='hiddenbtn' name='id' value='" . $friendrow["id"] . "'>" .
                            "<input type='submit' class='btn' name='addfriend' value='Добавить в друзья'>" .
                            "</form>
                            </div>
                        </div>";
                        if (isset($_POST['addfriend'])) {
                            $pagefriendid = $_POST['id'];
                            $addfriend = "INSERT INTO `friend` (`idUser`, `idFriend`) VALUES ('$userid', '$pagefriendid')";
                            if ($conn->query($addfriend));
                        }
                    }
                }

                ?>
            </div>

        </div>
    </div>
</body>

</html>
</body>

</html>