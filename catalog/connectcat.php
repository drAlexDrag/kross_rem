<?php
$host = 'localhost';				// Сервер
  	$user = 'dron';			// Имя пользователя
	$password = 'port2100';	// Пароль пользователя
	$database = 'kross';				// Имя базы данных

	// Подключаемся к серверу
	$connect = mysqli_connect($host, $user, $password, $database) or die("<p>Невозможно подключиться к СУБД: " . mysqli_connect_error() . ". Ошибка произошла в строке " . __LINE__ . "</p>");
?>