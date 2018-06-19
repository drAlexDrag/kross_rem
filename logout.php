<?
/**
  * Скрипт выхода пользователя из системы. Так как пользователи
  * авторизуются через сессии, их логин и пароль хранятся
  * в суперглобаном массиве $_SESSION. Чтобы осуществить
  * выход из системы, достаточно просто уничтожить значения
  * массива $_SESSION['login'] и $_SESSION['password'], после
  * чего мы переадресовываем пользователя к странице авторизации
  */

require('connect.php');
//unset($_SESSION['login']);
//unset($_SESSION['password']);
$_SESSION = array();//очищаем весь массив
header( 'Location: login.php');
//header('Refresh: 5; URL = index.php');
?>
