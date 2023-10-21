<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Регистрация </title>
    <b><a href="Registration.php" style="color:#708090; text-decoration:none">  Регистрация </a></b>
    <p></p>
    <b><a href="Authorization.php" style="color:#708090; text-decoration:none">  Войти </a></b>
</head>
<body bgcolor = "#663399">
<center><h1> Регистрация </h1></center>
<form name="interest" method="post">
    <center><p> &#128100; Имя:</center>
    <center><p> <input type="text" name=userName placeholder="Введите имя" size="30" maxlength="50"></input></center>
    <center><p> &#128100; Фамилия:</center>
    <center><p> <input type="text" name=userSurname placeholder="Введите фамилию" size="30" maxlength="50"></input></center>
    <center>
    <?php
    if (isset($_POST['EventOfRegistration']))
    {
        $userName = $_POST['userName'];
        $userSurname = $_POST['userSurname'];
        if ($userName == null || $userSurname == null)
        {
            echo "Введите данные !";
        }
        else
        {
            $WorkWithPDO = new PDO('mysql:dbname=php_SHEVARIKHIN;host=localhost', 'root', '');
            $Set = "INSERT INTO readers(last_name,first_name) 
            values('$userSurname','$userName')";
            $WorkWithPDO->exec($Set);
            setcookie('userName', $userName, time() + (86400 * 30), '/');                            // Передаем cookie парамтры на клиентсую сторону
            setcookie('userSurname', $userSurname, time() + (86400 * 30), '/');
            header("Location: GOODRegistration.php");                                        // Переходим на другую страничку
            exit();
        }
    }

    ?>
    </center>

    <center><p><input name = "EventOfRegistration" type="submit" value="Регистрация"></input></center>

    <pre id="profile"></pre>
</form>
</body>
</html>