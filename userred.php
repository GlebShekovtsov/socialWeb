<?php
session_start();
$conn = mysqli_connect("localhost", "root", "root", "socialwebdb");
$userid = $_SESSION['userid'];
$userInfoSelect = "SELECT * FROM `page` WHERE userId = '$userid'";
$userInfoSelectResult = mysqli_query($conn, $userInfoSelect);
$userInfoFetchAssoc = mysqli_fetch_assoc($userInfoSelectResult);
if (isset($_POST['redact']) && !empty($userInfoFetchAssoc)) {
} else if (empty($userInfoFetchAssoc) && isset($_POST['redact'])) {
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/RedPageStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <title>Страница</title>
</head>

<body>
    <div class="container">
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
        <div class="mainPage">
            <div class="userAvatar">
                <div class="avatar">
                    <div class="avatarplace">
                        <figure class="avatarfigure">
                            <?php echo "<img class='avatarimage' src='img/" . $userInfoFetchAssoc['avatar'] . "' alt='Ваша аватарка'>" ?>
                        </figure>
                    </div>
                    <div class="redAvatar">
                        <form method='POST' class="avatarform" enctype="multipart/form-data">

                            <input type="file" class='btn' name='image'>
                            <input type="submit" class='btn' name='avatarsubmit'>

                        </form>
                        <?php
                        if (isset($_POST['avatarsubmit'])) {
                            if (!empty($_FILES["image"]["tmp_name"])) {
                                $name = $_FILES["image"]["name"];
                                $path = __DIR__ . '/img/';
                                move_uploaded_file($_FILES["image"]["tmp_name"], $path . $name);
                                $avatarAdd = "UPDATE `page` SET `avatar` = '$name' WHERE userId='$userid'";
                                if ($conn->query($avatarAdd)) {
                                    echo "<p>Аватар обновлен</p>";
                                } else {
                                    echo "<p> Ошибка: " . $conn->error . "</p>";
                                }
                            }
                        }
                        ?>
                    </div>
                </div>

            </div>

            <div class="userList">

                <div class="userInfo">
                    <?php if (isset($_POST['redact']) && !empty($userInfoFetchAssoc)) {
                        echo "<form method='POST' class='redform'>
                        <label for=''>ФИО:</label>
                        <textarea name='fullName' cols='20' rows='3' class='input'"  . ">" . $userInfoFetchAssoc["fullName"] . "</textarea>
                        <label for=''>Статус:</label>
                        <textarea name='status' cols='20' rows='10' class='input'"  . ">" . $userInfoFetchAssoc["status"] . "</textarea>
                        <label for=''>Город:</label>
                        <input type='text' class='input' name='city' value='" . $userInfoFetchAssoc["city"] . "' required>
                        <label for=''>Информация о себе:</label>
                        <textarea name='about' cols='25' rows='15' class='input'"  . ">" . $userInfoFetchAssoc["about"] . "</textarea>
                        <label for=''>Работа:</label>
                        <textarea name='job' cols='20' rows='5' class='input'"  . ">" . $userInfoFetchAssoc["job"] . "</textarea>
                        <label for=''>Любимые игры:</label>
                        <textarea name='favGames' cols='20' rows='5' class='input'"  . ">" . $userInfoFetchAssoc["favGames"] . "</textarea>
                        <label for=''>Любимая музыка:</label>
                        <textarea name='favMusic' cols='20' rows='5' class='input'"  . ">" . $userInfoFetchAssoc["favMusic"] . "</textarea>
                        <input type='submit' name='redsubmit' class='btn' value='Редактировать'>
                        </form>";
                    } else if (isset($_POST['redact']) && empty($userInfoFetchAssoc)) {
                        echo "<form method='POST' class='redform'>
                        <label for=''>ФИО:</label>
                        <textarea name='fullName' cols='20' rows='3' class='input'></textarea>
                        <label for=''>Статус:</label>
                        <textarea name='status' cols='20' rows='10' class='input'></textarea>
                        <label for=''>Город:</label>
                        <input type='text' class='input' name='city' required>
                        <label for=''>Информация о себе:</label>
                        <textarea name='about' cols='25' rows='15' class='input'></textarea>
                        <label for=''>Работа:</label>
                        <textarea name='job' cols='20' rows='5' class='input'></textarea>
                        <label for=''>Любимые игры:</label>
                        <textarea name='favGames' cols='20' rows='5' class='input'></textarea>
                        <label for=''>Любимая музыка:</label>
                        <textarea name='favMusic' cols='20' rows='5' class='input'></textarea>
                        <input type='submit' name='pagesubmit' class='btn' value='Редактировать'>
                        </form>";
                    }
                    ?>
                    <?php
                    if (isset($_POST['pagesubmit'])) {

                        $fullName = $_POST["fullName"];
                        $city = $_POST["city"];
                        $placeholder = "1.png";
                        $status = $_POST["status"];
                        $about = $_POST["about"];
                        $job = $_POST["job"];
                        $userid = $_SESSION['userid'];
                        $favGames = $_POST["favGames"];
                        $favMusic = $_POST["favMusic"];
                        $userPageInsert = "INSERT INTO `page` (`userId`, `fullName`, `city`, `about`, `avatar`, `status`, `job`, 
                        `favGames`, `favMusic`) VALUES('$userid', '$fullName', '$city', '$about', '$placeholder', '$status', '$job',
                        '$favGames', '$favMusic')";
                        if ($conn->query($userPageInsert)) {
                            echo "<p>Данные обновлены</p>";
                        } else {
                            echo "Ошибка: " . $conn->error;
                        }
                    }
                    ?>
                </div>
                <?php
                if (isset($_POST['redsubmit'])) {

                    $fullName = $_POST["fullName"];
                    $city = $_POST["city"];
                    $status = $_POST["status"];
                    $about = $_POST["about"];
                    $job = $_POST["job"];
                    $favGames = $_POST["favGames"];
                    $favMusic = $_POST["favMusic"];
                    $userPageUpdate = "UPDATE `page` SET `fullName`='$fullName', `city`='$city', `about`='$about', `status`='$status',
                    `job`='$job', `favGames`='$favGames', `favMusic`='$favMusic' WHERE userId='$userid'";
                    if ($conn->query($userPageUpdate)) {
                        echo "<p>Данные обновлены</p>";
                    } else {
                        echo "Ошибка: " . $conn->error;
                    }
                }

                ?>
            </div>

        </div>
        <div class="footer"></div>
    </div>
</body>

</html>