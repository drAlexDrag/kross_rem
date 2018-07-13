<?php
require 'connect.php'; // подключаем скрипт
$output = '';
if(isset($_POST["query"]))
{
$search = $_POST["query"];
  $logsta=R::getAll('SELECT * FROM logsta WHERE logsta.id LIKE ? OR logsta.datechange LIKE ? OR logsta.tab LIKE ? OR logsta.idval LIKE ? OR logsta.val LIKE ? OR logsta.user LIKE ? OR logsta.operation LIKE ?  ORDER BY id DESC', ['%' .$search. '%', '%' .$search. '%', '%' .$search. '%', '%' .$search. '%', '%' .$search. '%', '%' .$search. '%', '%' .$search. '%']);
 
}
else
{

  $logsta=R::getAll('SELECT * FROM logsta ORDER BY id DESC LIMIT 100');

}
if($logsta!=null){
   $output .= '
  <div class="table-responsive">
   <table class="table table-bordered table-condensed table-hover table-fixed">
   <input class="form-control" id="myInput" type="text" placeholder="Отфильтровать в найденном...">
  <hr>
   <thead>
<tr>
<th>ID</th>
<th>Дата</th>
<th>Таблица</th>
<th>ID значения</th>
<th>Значение</th>
<th>Оператор</th>
<th>Операция</th>
</tr></thead><tbody id="myTable">
 ';
  foreach($logsta as $row)
 {

 $output .= '
   <tr>
    <td>'.$row["id"].'</td>
  <td>'.$row["datechange"].'</td>
  <td>'.$row["tab"].'</td>
  <td>'.$row["idval"].'</td>
  <td>'.$row["val"].'</td>
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