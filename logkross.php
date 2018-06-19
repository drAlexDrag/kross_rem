<?php
require 'connect.php'; // подключаем скрипт
$output = '';
if(isset($_POST["query"]))
{
$search = $_POST["query"];
  $logkross=R::getAll('SELECT * FROM logkross WHERE logkross.data_id LIKE ? OR logkross.data_name LIKE ? OR logkross.raspred LIKE ? OR logkross.number LIKE ? OR sub LIKE ? OR type LIKE ? OR comment LIKE ? OR area LIKE ? OR user LIKE ? OR operation LIKE ? ORDER BY id DESC', ['%' .$search. '%', '%' .$search. '%', '%' .$search. '%', '%' .$search. '%', '%' .$search. '%', '%' .$search. '%', '%' .$search. '%', '%' .$search. '%', '%' .$search. '%', '%' .$search. '%']);
 
}
else
{

  $logkross=R::getAll('SELECT * FROM logkross ORDER BY id DESC LIMIT 100');

}
if($logkross!=null){
   $output .= '
  <div class="table-responsive">
   <table class="table table-bordered table-condensed table-hover table-fixed">
   <input class="form-control" id="myInput" type="text" placeholder="Отфильтровать в найденном...">
  <hr>
   <thead>
<tr>
<th>ID</th>
<th>Дата</th>
<th>ID данных</th>
<th>Данные</th>
<th>Распределение</th>
<th>Телефон</th>
<th>Абонент</th>
<th>Тип</th>
<th>Комментарии</th>
<th>Площадка</th>
<th>Оператор</th>
<th>Операция</th>
</tr></thead><tbody id="myTable">
 ';
  foreach($logkross as $row)
 {

 $output .= '
   <tr>
    <td>'.$row["id"].'</td>
  <td>'.$row["datechange"].'</td>
  <td>'.$row["data_id"].'</td>
  <td>'.$row["data_name"].'</td>
  <td>'.$row["raspred"].'</td>
  <td>'.$row["number"].'</td>
  <td>'.$row["sub"].'</td>
  <td>'.$row["type"].'</td>
  <td>'.$row["comment"].'</td>
  <td>'.$row["area"].'</td>
  <td>'.$row["user"].'</td>
  <td>'.$row["operation"].'</td>
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