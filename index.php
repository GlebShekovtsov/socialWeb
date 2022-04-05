<?

session_start();
if(!empty($_POST['submitauth'])){
  header('Refresh: 0');

}
if (isset($_SESSION['userid'])) {
  header('Location: userpage.php');
} 
$conn = mysqli_connect("localhost", "root", "root", "socialwebdb");
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/MainPageStyle.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>  
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500&family=Roboto&display=swap" rel="stylesheet">
  <title>Главная</title>
</head>

<body>
  <div class="container">
    <div class="menu">
      <div class="left">
        <h1>DырNet</h1>
      </div>
      <div class="right"></div>
    </div>
    <div class="mainInfo">
      <div class="infoblock">
        <div class="infolabel">
          <h2>Лучшая социальная сеть на территории заповедника "ДырГора"</h2>
        </div>
        <div class="info">
          <div class="picturecontainer">
            <figure class="picturefigure">
              <img src="img/dirmountain.jpg" class="picture1">
              <figcaption class="picture1caption">
                Наша штаб-квартира
              </figcaption>
            </figure>

            <p>
              На территории ДырГоры живут самые лучшие и прекрасные люди, многие хотят с ними общаться, и этот сайт поможет вам в этом.
              Довакин ДырГоры Дмитрий Иванов всегда рад пообщаться с вами на различные темы, начиная от ведьмака заканчивая скайримом и конечно же пубгом.
            </p>
          </div>
        </div>
        <div class="mainfooter">
        </div>

      </div>
    </div>
    <div class="loginContent">
      <div class="aboutInfo"></div>
      <div class="regBlock">
        <div class="welcomeLabel">
          <h1>Впервые у нас? Зарегистрируйтесь</h1>
        </div>

        <div class="regInfoBlock">
          <div class="logininput">
            <h3>Быстрая регистрация</h3>
          </div>
          <div class="fastreginfo">
            <form method="POST" class="regform">
              <label for="">Введите логин:</label>
              <input type="text" class="input" name="loginreg" required>
              <label for="">Введите пароль:</label>
              <input type="password" class="input" name="passwordreg">
              <input type="submit" name="submitreg" class="btn" value="Зарегистрироваться" required>

            </form>
            <?php
            if (isset($_POST['submitreg'])) {
              $login = $_POST['loginreg'];
              $password = password_hash($_POST['passwordreg'], PASSWORD_DEFAULT);
              $userInsertion = "INSERT INTO `user` (`login`, `password`) VALUES ('$login', '$password')";
              
              if ($conn->query($userInsertion)) {
                echo "<p>" . "Регистрация прошла успешно" . "</p>";
              } else {
                echo "<p>" . "Ошибка:" . $conn->error . "</p>";
              }
            }
            ?>
          </div>
        </div>
        <div class="welcomeFotter">
          <span class="welcomespan">
            Регистрируясь у нас вы подтверждаете, что продаете свою душу Дмитрию Иванову.
            ОАО "ДырГора" со всем уважением к вам.
          </span>
        </div>
      </div>
      <div class="loginBlock">
        <div class="loginLabels">

          <form method="POST" class="loginform">
            <label for="">Введите логин:</label>
            <input type="text" class="input" name="login" required>
            <label for="">Введите пароль:</label>
            <input type="password" class="input" name="password" required>

            <input type="submit" name="submitauth" class="btn" value="Войти">
          </form>
          <?php
          if (isset($_POST["login"]) && isset($_POST["password"])) {
            $login = $_POST["login"];
            $auth = "SELECT * FROM `user` WHERE login='$login'";
            $authResult = mysqli_query($conn, $auth);
            $authAssoc = mysqli_fetch_assoc($authResult);
            if (!empty($authAssoc)) {
              $hash = $authAssoc['password'];
              if (password_verify($_POST['password'], $hash)) {
                $userid = $authAssoc['id'];
                $userlogin = $authAssoc['login'];
                $_SESSION["login"] = $userlogin;
                $_SESSION["userid"] = $userid;

              } else {
                echo "<p>Пароль неверный</p>";
              }
            } else {
              echo "<p>Пользователя с таким логином не существует</p>";
            }
          }
          ?>
        </div>

      </div>
    </div>



  </div>
</body>

</html>