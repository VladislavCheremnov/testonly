<?php
    require_once('db.php');

    
    if(isset($_POST['submit'])){
        $err = [];

        #Валидация логина.
        if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login'])){
        
            $err[] = "В поле логин могут быть только латинские символы и цифры.";
        }

        if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30){
        
            $err[] = "Поле логин должно содержать от 3 до 32 символов.";
        }

        #Проверка почты на уникальность.
        $query = mysqli_query($link, "SELECT id FROM users WHERE email='".mysqli_real_escape_string($link, $_POST['email'])."'");

        if(mysqli_num_rows($query) > 0){
        
            $err[] = "Такая почта уже зарегистрирована!";
        }

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
    Логин <input name="login" type="text" required><br>
    Email <input name="email" type="email" required><br>
    Пароль <input name="password" type="password" required><br>
    Повторите пароль <input name="repeatpassword" type="password" required><br>
    <input name="submit" type="submit" value="Зарегистрироваться">
    </form>