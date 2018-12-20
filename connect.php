<?php
require "libs/rb.php";
R::setup( 'mysql:host=localhost;dbname=kross', 'dron', 'port2100' ); //for both mysql or mariaDB
// R::setup( 'mysql:host=192.168.50.37;dbname=kross', 'dron', 'port2100' );
if ( !R::testConnection() )
{
        exit ('Нет соединения с базой данных');
}
session_start();
require 'myfunction.php';
?>