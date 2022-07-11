<?php
    require_once('db.php');

    if(!isset($_POST['submit'])){

    echo "Регистрация прошла успешно!";

    } else {

        #Вытаскиваем из БД запись, у которой логин равняется введенному

        $query = mysqli_query($link,"SELECT id, password FROM users WHERE login='".mysqli_real_escape_string($link,$_POST['login'])."' LIMIT 1");
        $result = mysqli_fetch_assoc($query);

        if($result['password'] === $_POST['password']){
            echo "Авторизация прошла успешно!";
        } else {
            echo "Не верный логин или пароль!";
        }
    }
?>

<form method="POST">
    <p><input name="login" type="text" required> Логин</p>
    <p><input name="password" type="password" required> Пароль</p>
<input name="submit" type="submit" value="Войти">
</form>