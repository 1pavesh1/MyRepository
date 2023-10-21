<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Авторизация </title>
    <b><a href="Registration.php" style="color:#708090; text-decoration:none">  Регистрация </a></b>
    <p></p>
    <b><a href="Authorization.php" style="color:#708090; text-decoration:none">  Войти </a></b>
</head>
<body bgcolor = "#663399">
<center><h1> Авторизация </h1></center>
<form name="interest" method="POST">
    <center><p> &#128100; Имя:</center>
    <center><p> <input type="text" name=userName placeholder="Введите имя" size="30" maxlength="50"></input></center>
    <center><p> &#128100; Фамилия:</center>
    <center><p> <input type="text" name=userSurname placeholder="Введите фамилию" size="30" maxlength="50"></input></center>
    <center>
    <?php
    $connect = mysqli_connect('localhost','root','','php_SHEVARIKHIN'); // Подключаемся к БД
    if ( isset($_POST['EventOfAuthorization']) )                                                         // Проверяем нажал ли пользователь на кнопку
    {
        $userName = $_POST['userName'];
        $userSurname = $_POST['userSurname'];
        if ( $userName == null || $userSurname == null )                                                 // Если одного параметра нету, то просим ввести их
        {
            echo "Введите данные !";
        }
        else
        {
            if ( authorizationCheck($userName, $userSurname) )                                           // Если пользователь в БД есть, то он успешно авторизируется
            {
                setcookie('userName', $userName, time() + (86400 * 30), '/');                            // Передаем cookie парамтры на клиентсую сторону
                setcookie('userSurname', $userSurname, time() + (86400 * 30), '/');
                header("Location: GOODAuthorization.php");                                        // Переходим на другую страничку
                exit();
            }
            else
            {
                echo "Данные неверны !";
            }
        }
    }
    function CheckCookie()                                                                              // Функция для проверки cookie
    {
        $OriginalUserName = $_COOKIE['userName'];
        $OriginalUserSurname = $_COOKIE['userSurname'];
        if ( authorizationCheck($OriginalUserName, $OriginalUserSurname) )
        {
            return $OriginalUserName;
        }
        return null;
    }
    function authorizationCheck ( $userName, $userSurname )                                             // Функция для проверки пользоватлея в БД
    {
        $connect = mysqli_connect('localhost','root','','php_SHEVARIKHIN');
        $Set = 'SELECT last_name, first_name
                    FROM readers';
        $readers = mysqli_query($connect, $Set);
        while ( $row = $readers->fetch_assoc() )
        {
            if ( $row['first_name'] == $userName && $row['last_name'] == $userSurname )
            {
                return true;
            }
        }
        return false;
    }
    mysqli_close($connect);
    ?>
    </center>
    <center><p><input name = "EventOfAuthorization" type="submit" value="Авторизация"></input></center>
</form>
</body>
</html>