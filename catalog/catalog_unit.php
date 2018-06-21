<?php
require_once 'connect.php';
if(isset($_POST["unit_name"]))
{
  $unit_name=$_POST["unit_name"];
  $unit_id=R::getCol('select id from unit where unit_name=?', [$_POST["unit_name"]]);
  $unit_id=$unit_id[0];
  

  $output = '';
  $output_nav = '';
  $output_unit = '';
  $beans = R::getAll('SELECT catalog.id, sub.sub_name, catalog.vnutr, catalog.city, unit.unit_name, department.department_name, catalog.cabinet, filial.filial_name, catalog.visibility
    FROM catalog
    INNER JOIN sub ON catalog.sub_id = sub.id
    INNER JOIN unit ON catalog.unit_id = unit.id
    INNER JOIN department ON catalog.department_id = department.id
    INNER JOIN filial ON catalog.filial_id = filial.id
    WHERE unit.id=? AND department.id=1 AND visibility NOT IN ("0") ORDER BY weight DESC', [$unit_id]);

  $output_nav .='<div class="sector"><a href="#" onclick="loadData(1)"><span>Справочник телефонов <span class="glyphicon glyphicon-forward"></span></a><a href="#" class="alert alert-info" style="color:blue; pointer-events: none">'.$unit_name.'</a></div><hr>';
  $output_unit .= '
  
  <div class="table-responsive">
  <table class="table table-bordered table-hover">
  <tr>
  <th>Абонент</th>
  <th>Телефон</th>
  <!--th>Городской</th>
  <th>Управление</th>
  <th>Отдел/Бюро</th-->
  <th>Кабинет</th>
  <!--th>Филиал</th-->
  <th>Сообщить об ошибке</th>
  </tr>';
  foreach($beans as $row)
  {
   $output_unit .= '
   <tr>
   <td class="info">'.$row["sub_name"].'</td>
   <td>'.$row["vnutr"].'</td>

   <td>'.$row["cabinet"].'</td>
   <!--td>'.$row["filial_name"].'</td-->
   <td align="center"><button type="button" name="btn_obr" id="btn_obr" class="btn btn-xs btn-success feedback btn-block" data-catalogid="'.$row["id"].'"><span class="glyphicon glyphicon-edit"></span></button></td>
   </tr>
   ';

 }
 if ($beans!=null) {
   $output_unit .= '</table></div>';
 } else {
   $output_unit= '<div class="alert alert-danger">Информация по подразделению отсутствует</div>';
 }
 


 $beans = R::getAll('SELECT DISTINCT catalog.unit_id, catalog.department_id, unit.id, unit.unit_name, department.id, department.department_name
  FROM catalog
  INNER JOIN unit ON catalog.unit_id = unit.id
  INNER JOIN department ON catalog.department_id = department.id
  WHERE unit.id=? AND department.id<>1', [$unit_id]);

 // $output.='<div class="col-sm-6" style="background-color: black;"><ul>';
 if ($beans!=null){
  // $output.='<!--h3 style="color:blue">'.$unit_name.fdfdfdf'</h3-->';
  $output .= '<div class="row"><div class="col-sm-6">'.$output_unit.'</div>';
  // $output.='<h5>Доступные подразделения : </h5><div class="col-sm-6 well"><ul>';
  // $output .= '</div></div>';
   $output.='<div class="col-sm-6 well"><ul>';
} else {
  $output .= '<div class="row"><div class="col-sm-12">'.$output_unit.'</div></div>';

  //$output .= '</div><div>';
   //$output.='<div class="col-sm-6" style="background-color: blue;"><ul>';
  
}

foreach($beans as $row)
{

  if ($row["department_name"]==NULL) {
    $output .='';
  } else{
   $output .='<li><a class="departmentcatalog" style="color:blue; cursor: pointer;" data-id="'.$row["department_id"].'" data-name="'.$row["department_name"].'" data-unitname="'.$row["unit_name"].'" data-unitid="'.$row["unit_id"].'">'.$row["department_name"].'</li></a>';
 }

}


$output.='</ul></div></div>';


}
$output.='</div>';
$output_nav.=$output;
$output=$output_nav;
echo  $output;

?>