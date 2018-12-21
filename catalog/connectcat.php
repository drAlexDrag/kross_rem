<?php
require_once "../PHPDebug/PHPDebug.php";
// $host = 'localhost';				// Сервер
$host = '192.168.50.37';				// Сервер
  	$user = 'dron';			// Имя пользователя
	$password = 'port2100';	// Пароль пользователя
	$database = 'kross';				// Имя базы данных

	// Подключаемся к серверу
	$connect = mysqli_connect($host, $user, $password, $database) or die("<p>Невозможно подключиться к СУБД: " . mysqli_connect_error() . ". Ошибка произошла в строке " . __LINE__ . "</p>");
?>