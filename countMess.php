<?php
require_once 'connect.php';
$argument="0";
$count=R::count('message', ' state = ? ', [$argument]);
echo $count;
?>