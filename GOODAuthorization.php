<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Успех </title>
</head>
<body bgcolor = "#663399">

        <?php require __DIR__ . '/Authorization.php';                   // Передаём функцию CheckCookie()
        $userName = CheckCookie();
        ?>
    <center>
        <?php
        if ($userName == null)                                          // Если параметр равен null, то отправляем пользователя назад на авторизацию
        {
            header("Location: Authorization.php");
        }
        else
        {
            echo " ", $userName;
        }
        ?>
        вы успешно авторизовались
        <p><b><a href="Exit.php" style="color:#708090; text-decoration:none">  Выйти </a></b></p>
    </center>
</form>
</body>
</html>