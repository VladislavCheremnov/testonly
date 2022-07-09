<?php
    function login_validation()
    {   
        if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login'])){
        
            return $err[] = "В поле логин могут быть только латинские символы и цифры.";
        }

        if(strlen($_POST['login']) < 3 or strlen($_POST['login'] > 30)){
        
            return $err[] = "Поле логин должно содержать от 3 до 32 символов.";
        }

        /*else {
            return $err[] = NULL;
        }*/
    }
?>