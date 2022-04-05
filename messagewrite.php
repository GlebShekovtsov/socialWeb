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
    <link rel="stylesheet" href="style/MessageWritePage.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500&family=Roboto&display=swap" rel="stylesheet">
    <title>Написание сообщение</title>
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
                    <h2>Введите ваше сообщение</h2>
                </div>
                <div class="messageblockform">
                    <form class="messageform" method="POST">
                        <textarea name="text" class='input' cols="30" rows="10"></textarea>
                        <input type="submit" name="send" class="btn" value="Отправить">
                    </form>
                    <?php
                    
                    if(isset($_POST['send'])) {

                        $recId = $friendpageid;
                        $senId = $senderpageid;
                        $text = $_POST['text'];
                        $status = "Не прочитано";
                        $msgAdd = "INSERT INTO `message` (`senderId`, `recId`, `text`,`status`) VALUES
                        ('$senId', '$friendpageid', '$text', '$status')";
                        $conn->query($msgAdd);
                        echo "<p>" ."Сообщение отправлено". "</p>";
                    }
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>