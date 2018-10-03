<?php
//catalog_select.php
require_once 'connectcat.php';
require_once 'connect.php';
require_once "../PHPDebug/PHPDebug.php";
$debug = new PHPDebug();
 if (isset($_POST)) {

  $log_n_tel= $_POST["log_n_tel"];
  if ($log_n_tel != "") {
$output = '';
// $log_n_tel= mysqli_real_escape_string($connect, $_POST["log_n_tel"]);
  $strSQL=R::getAll("SELECT catalog.id, sub.sub_name, catalog.vnutr, catalog.city, unit.unit_name, department.department_name, catalog.cabinet, filial.filial_name, catalog.visibility
FROM catalog
INNER JOIN sub ON catalog.sub_id = sub.id
INNER JOIN unit ON catalog.unit_id = unit.id
INNER JOIN department ON catalog.department_id = department.id
INNER JOIN filial ON catalog.filial_id = filial.id
WHERE sub.sub_name
LIKE \"%".$log_n_tel."%\" OR catalog.vnutr LIKE \"%".$log_n_tel."%\" AND visibility NOT IN ('0')");
  // var_dump($strSQL);
$debug->debug($log_n_tel, null, LOG);
   // $result = mysqli_query($connect, $strSQL);// Выполнить запрос (набор данных $result содержит результат)
 $output .= '
<div class="alert alert-info">Ищем  
<strong>'.$log_n_tel.'</strong>
</div>
  <div class="table-responsive" >
           <table class="table table-bordered table-hover">
                <tr>
                     <th>Абонент</th>
                     <th>Телефон</th>
                     <th>Управление</th>
                     <th>Отдел/Бюро</th>
                     <th>Кабинет</th>
                     <th>Филиал</th>
                     <th>Сообщить об ошибке</th>
                </tr>';
foreach($strSQL as $row)
{
  
// }
 // if(mysqli_num_rows($result) > 0)
 // {
 //      while($row = mysqli_fetch_array($result))
 //      {
           $output .= '
                <tr>
                     <td class="info">'.$row["sub_name"].'</td>
                     <td>'.$row["vnutr"].'</td>
                     <td>'.$row["unit_name"].'</td>';
                     if (($row["department_name"])=="ND") {
                      $output .= '<td>'.$row["unit_name"].'</td>';
                     }
                     else {
                      $output .= '<td>'.$row["department_name"].'</td>';
                     }
            $output .= '
            <td>'.$row["cabinet"].'</td>
                     <td>'.$row["filial_name"].'</td>
                     <td><button type="button" name="btn_obr" id="btn_obr" class="btn btn-xs btn-success feedback btn-block" data-catalogid="'.$row["id"].'"><span class="glyphicon glyphicon-edit"></span></button></td>
                </tr>
           ';
 //      }

 // }
 }
 if ($strSQL==null){$output=''; $output='<br><div class="alert alert-info">По 
<strong>'.$log_n_tel.'</strong> информация отсутствует.
</div>';}
 // else
 // {
 //      $output .= '<tr>
 //                          <td colspan="7"><div style="border: 3px solid red; width: auto; height: auto; padding: 10px;" id="result_div_id">
 //            <em>По запросу <strong>'.$log_n_tel.'</strong> ничего не найдено!</em>
 //        </div></td>
 //                     </tr>';
 // }

 
 
  $output .= '</table>
      </div>';
    
 // echo $output;
}
else {$output=''; $output='<br><div class="alert alert-danger">
 <strong></strong> Пустая строка поиска.
 </div>'; }
}echo $output;
 ?>