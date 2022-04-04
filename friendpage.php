<?php
session_start();
$conn = mysqli_connect("localhost", "root", "root", "socialwebdb");
if(isset($_POST['checkpage'])){
    $pageid = $_POST['id'];
    $friendid = $_POST['userId'];
}
$userInfoSelect = "SELECT * FROM `page` WHERE id = '$pageid'";
$userInfoSelectResult = mysqli_query($conn, $userInfoSelect);
$userInfoFetchAssoc = mysqli_fetch_assoc($userInfoSelectResult);

?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/UserPageStyle.css">
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
        </div>
        <div class="actions">

        </div>
      </div>
      <div class="friendList">
        <div class="FriendLabel">
          <h2>Ваши друзья: </h2>
        </div>
        <div class="FriendListOut"></div>

      </div>
      <div class="userList">
        <div class="userName">
          <div class="userFullName">
            <?php
            echo $userInfoFetchAssoc['fullName']
            ?>
          </div>
          <div class="userStatus">
            <p> <?php echo $userInfoFetchAssoc['status'] ?>
            <p>
          </div>

        </div>
        <div class="userInfo">
          <span><?php echo "Город: " . $userInfoFetchAssoc['city']  ?></span>
          <p><?php echo "Информация о себе: " . $userInfoFetchAssoc['about']  ?></p>
          <span><?php echo "Место работы: " . $userInfoFetchAssoc['job']  ?></span>
          <p><?php echo "Любимые игры: " . $userInfoFetchAssoc['favGames']  ?></p>
          <p><?php echo "Любимая музыка: " . $userInfoFetchAssoc['favMusic']  ?></p>


        </div>
        <div class="userRedaction">


        </div>
      </div>
      <div class="gallery">
        <div class="galleryLabel">
          <h2>Галерея</h2>
        </div>
        <div class="PhotoOut">
          <?php
          $gallerySelection = "SELECT * FROM `gallery` WHERE userId = '$friendid' ORDER BY rand() LIMIT 4";
          $gallerySelectionResult = mysqli_query($conn, $gallerySelection);
          foreach ($gallerySelectionResult as $galleryRow) {
            echo "
            <figure class='gallery__item'>
            <img src='img/" . $galleryRow['image'] . "' class='gallery__img' alt='Картинка'>
            </figure>";
          }
          ?>

        </div>
        <div class="galleryButton">
         
        </div>
      </div>
    </div>
    <div class="footer"></div>
  </div>
</body>

</html>