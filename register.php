<?php
    require_once('modules/db.php');
    require_once('modules/function.php');

    
    if(isset($_POST['submit'])){
        $err = [];

        #Валидация логина.
        login_validation($_POST['login']);

        #Проверка почты на уникальность.
        /*$query = mysqli_query($link, "SELECT id FROM users WHERE email='".mysqli_real_escape_string($link, $_POST['email'])."'");

        if(mysqli_num_rows($query) > 0){
        
            $err[] = "Такая почта уже зарегистрирована!";
        }*/

        #Проверка на идентичность паролей в обоих полях.

        if($_POST['password'] != $_POST['repeatpassword']){

            $err[] = "Пароли в полях отличаются.";
        }

        #Проверяем на ошибки. Если все нормально, то обрезаем лишние пробелы и добавляем нового пользователя.

        if(count($err) == 0){
        

            $login = trim($_POST['login']);
            $password = trim($_POST['password']);
            $email = trim($_POST['email']);
            

            mysqli_query($link,"INSERT INTO users SET login='".$login."', password='".$password."', email='".$email."'");
            header("Location: login.php"); exit();
        } else {
            echo "<b>Исправьте, пожалуйста, следующие ошибки:</b><br>";
            foreach($err AS $error)
            {
                echo $error."<br>";
            }
        }
    }
?>

    <form method="POST">
        <p><input name="login" type="text" required> Логин</p>
        <p><input name="email" type="email" required> Email</p>
        <p><input name="password" type="password" required> Пароль</p>
        <p><input name="repeatpassword" type="password" required> Повторите пароль</p>
    <input name="submit" type="submit" value="Зарегистрироваться">
    </form>