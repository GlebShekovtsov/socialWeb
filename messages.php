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
    <title>Сообщения</title>
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

            </div>
            <div class="friensgrid">



                <?php
                $FriendSelect = "SELECT * FROM `friend` WHERE idUser = '$userid'";
                $FriendSelectResult = mysqli_query($conn, $FriendSelect);
                $FriendFetchAssoc = mysqli_fetch_assoc($FriendSelectResult);
                $friendid = $FriendFetchAssoc['idFriend'];
                $FriendPageSelect = "SELECT * FROM `page` WHERE id ='$friendid'";
                $FriendPageSelectResult = mysqli_query($conn, $FriendPageSelect);
                foreach ($FriendPageSelectResult as $friendrow) {
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
                            <form class='descform'  action='messageview.php' method='GET'>" .
                        "<input type='submit' class='btn' name='checkmsg' value='Просмотреть сообщения'>" .
                        "<input type='hidden' class='hiddenbtn' name='pageid' value='" . $friendrow["id"] . "'>" .
                        "<input type='hidden' class='hiddenbtn' name='userId' value='" . $friendrow["userId"] . "'>
                        </form>" .
                        "<form class='descform'  action='messagewrite.php' method='GET'>" .
                        "<input type='submit' class='btn' name='checkmsg' value='Написать сообщение'>" .
                        "<input type='hidden' class='hiddenbtn' name='pageid' value='" . $friendrow["id"] . "'>" .
                        "<input type='hidden' class='hiddenbtn' name='userId' value='" . $friendrow["userId"] . "'>
                        </form>";
                }


                ?>
            </div>

        </div>
    </div>
</body>

</html>
</body>

</html>