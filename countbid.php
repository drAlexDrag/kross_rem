<?php
require_once 'connect.php';
$argument="Открыта";
$count=R::count('bid', ' state = ? ', [$argument]);
  // foreach($bid as $row)
  // {
  //   echo json_encode($row);
  // }
echo $count;
?>