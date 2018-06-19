<?php
require 'connect.php'; // подключаем скрипт
$output = '';
if(isset($_POST["query"]))
{
$search = $_POST["query"];
  $bid=R::getAll('SELECT * FROM bid WHERE bid.id LIKE ? OR bid.phone LIKE ? OR bid.bidmessage LIKE ? OR bid.phoneobr LIKE ? OR bid.ipmessagebid LIKE ? ORDER BY bid.id DESC', ['%' .$search. '%', '%' .$search. '%', '%' .$search. '%', '%' .$search. '%', '%' .$search. '%']);
}
else
{

  $bid=R::getAll('SELECT * FROM bid ORDER BY id DESC LIMIT 100');

}
if($bid!=null){
   $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
<tr>
<th>ID</th>
<th>Дата</th>
<th>Номер</th>
<th>Сообщение</th>
<th>Телефон для связи</th>
<th>Комментарий по заявке</th>
<th>IP host</th>
<th>Статус заявки</th>
</tr>
 ';
  foreach($bid as $row)
 {
  switch ($row["state"]) {
          case 'Открыта':
            $color='class="w3-red"';
            break;
          case 'В работе':
            $color='class="w3-yellow"';
            break;
          case 'Закрыта':
            $color='class="w3-green"';
            break;

            $color='';
            break;
          }

 $output .= '
   <tr '.$color.'>
  <td class="readbid" onclick="stateBid('.$row["id"].')"><b>'.$row["id"].'</b><span class="glyphicon glyphicon-eye-open"></span></td>
  <td>'.$row["datemessage"].'</td>
  <td class="data-number" data-idnumber="'.$row["phone"].'">'.$row["phone"].'<span class="glyphicon glyphicon-search"></span></td>
  <td>'.$row["bidmessage"].'</td>
  <td>'.$row["phoneobr"].'</td>
  <td>'.$row["commentbid"].'</td>
  <td>'.$row["ipmessagebid"].'</td>
  <td>'.$row["state"].'</td>

   </tr>
  ';
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}

?>