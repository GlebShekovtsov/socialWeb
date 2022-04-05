<?php
session_start();
$conn = mysqli_connect("localhost", "root", "root", "socialwebdb");
$userid = $_SESSION['userid'];
$senderPageSelect = "SELECT * FROM `page` WHERE userId = '$userid'";
$senderPageResultSelect = mysqli_query($conn, $senderPageSelect);
$senderPageAssoc = mysqli_fetch_assoc($senderPageResultSelect);
$senderpageid = $senderPageAssoc['id'];
$friendpageid = $_GET['pageid'];
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сообщения</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/MessageView.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <title>Сообщения</title>
</head>

<body>
    <div class="container">
        <div class="menu">

        </div>
        <div class="leftmenu">
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
            <div class="messageblock">
                <div class="messagelabel">

                </div>
                <div class="messageblockform">
                    <?php
                    $recId = $friendpageid;
                    $senId = $senderpageid;
                    $messageSelect = "SELECT * FROM `message` WHERE senderId = '$senId' AND recId = '$recId'";
                    $messageResult = mysqli_query($conn, $messageSelect);
                    
                    ?>

                    <?php
                    foreach ($messageResult as $messageRow) {

                        echo "<p>" . $messageRow['text'] . "<a href=''>" . "[Отметить как прочитанное]" . "</a>" . "</p>";
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>