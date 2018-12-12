<?php
require '../connect.php'; // подключаем скрипт
$dataPost=$_POST;
if($dataPost["action"] == "upTree"){
	$catalog=R::load( 'catalog', $dataPost["id"] );
	$catalog->weight=$catalog->weight+1;
	R::store($catalog);
}

if($dataPost["action"] == "downTree"){
	$catalog=R::load( 'catalog', $dataPost["id"] );
	$catalog->weight=$catalog->weight-1;
	R::store($catalog);
}