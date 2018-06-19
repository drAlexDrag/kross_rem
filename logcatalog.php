<?php
require 'connect.php'; // подключаем скрипт
$output = '';
if(isset($_POST["query"]))
{
$search = $_POST["query"];
  $logkross=R::getAll('SELECT * FROM logcatalog WHERE logcatalog.catalog_id LIKE ? OR logcatalog.sub LIKE ? OR logcatalog.vnutr LIKE ? OR logcatalog.unit LIKE ? OR logcatalog.department LIKE ? OR logcatalog.cabinet LIKE ? OR logcatalog.filial LIKE ? OR logcatalog.visibility LIKE ? OR user LIKE ? OR operation LIKE ? ORDER BY id DESC', ['%' .$search. '%', '%' .$search. '%', '%' .$search. '%', '%' .$search. '%', '%' .$search. '%', '%' .$search. '%', '%' .$search. '%', '%' .$search. '%', '%' .$search. '%', '%' .$search. '%']);

}
else
{

  $logkross=R::getAll('SELECT * FROM logcatalog ORDER BY id DESC LIMIT 100');

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
<th>ID Абонента</th>
<th>Абонент</th>
<th>Телефон</th>
<th>Управление</th>
<th>Отдел/Бюро</th>
<th>Кабинет</th>
<th>Филиал</th>
<th>Видимость</th>
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
  <td>'.$row["catalog_id"].'</td>
  <td>'.$row["sub"].'</td>
  <td>'.$row["vnutr"].'</td>
  <td>'.$row["unit"].'</td>
  <td>'.$row["department"].'</td>
  <td>'.$row["cabinet"].'</td>
  <td>'.$row["filial"].'</td>
  <td>'.$row["visibility"].'</td>
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