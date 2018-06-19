<?php
require_once 'tconnect.php';
if(isset($_POST["unit_name"]))
{
  $dataPost=$_POST;
  $unit_name=$_POST["unit_name"];
  $unit_id=R::getCol('select id from unit where unit_name=?', [$_POST["unit_name"]]);
  $unit_id=$unit_id[0];
  $output = '';
  $output_nav = '';
  $output_unit = '';
  $beans = R::getAll('SELECT catalog.id, sub.sub_name, catalog.vnutr, catalog.city, unit.unit_name, department.department_name, catalog.cabinet, filial.filial_name, catalog.visibility, catalog.weight
    FROM catalog
    INNER JOIN sub ON catalog.sub_id = sub.id
    INNER JOIN unit ON catalog.unit_id = unit.id
    INNER JOIN department ON catalog.department_id = department.id
    INNER JOIN filial ON catalog.filial_id = filial.id
    WHERE unit.id=? AND department.id=1 AND visibility NOT IN ("0") ORDER BY weight DESC', [$unit_id]);
// var_dump($beans);
  $output_nav .='<a href="#" onclick="loadData()"><span>Справочник телефонов <span class="glyphicon glyphicon-forward"></span></span></a><a href="#" class="alert alert-info" style="color:blue; pointer-events: none">'.$unit_name.'</a><hr>';
  $output_unit .= '
  <div class="table-responsive"><h5>'.$unit_name.'</h5>
  <table class="table table-bordered table-hover">
  <tr>
  <th></th>
  <th>Абонент</th>
  <th>Телефон</th>
  <th>Филиал</th>
  <th>Вверх</th>
  <th>Вниз</th>
  <th>Вес</th>
  </tr>';
  foreach($beans as $row)
  {
   $output_unit .= '
   <tr>
   <td><div class="radio" >
   <label><input type="radio" name="rbsel" id="'.$row["vnutr"].'" onclick="rbSelect('.$row["vnutr"].')"></label>
   </div></td>
   <td class="info">'.$row["sub_name"].'</td>
   <td>'.$row["vnutr"].'</td>
   <td>'.$row["filial_name"].'</td>
   <td align="center"><button class="updown updown'.$row["vnutr"].'" id="upTree'.$row["vnutr"].'" data-action="upTree" data-name="'.$unit_name.'" data-id="'.$row["id"].'" hidden><span class="glyphicon glyphicon-arrow-up"></button></td>
   <td align="center"><button class="updown updown'.$row["vnutr"].'" id="downTree'.$row["vnutr"].'" data-action="downTree" data-name="'.$unit_name.'" data-id="'.$row["id"].'" hidden><span class="glyphicon glyphicon-arrow-down"></span></button></td>
   <td>'.$row["weight"].'</td>
   </tr>';
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
 if ($beans!=null){
  $output .= '<div class="row"><div class="col-sm-6">'.$output_unit.'</div>';
  $output.='<h5>Доступные подразделения : </h5><div class="col-sm-6 well"><ul>';
} else {
  $output .= '<div class="row"><div class="col-sm-12">'.$output_unit.'</div></div>';
}
foreach($beans as $row)
{
  if ($row["department_name"]==NULL) {
    $output .='';
  } else{
   $output .='<li><a onclick="departmentCatalog(this)" style="color:blue; cursor: pointer;" id="'.$row["department_id"].'" data-depname="'.$row["department_name"].'" data-name="'.$row["unit_name"].'" data-unitid="'.$row["unit_id"].'">'.$row["department_name"].'</li></a>';
 }
}
$output.='</ul></div></div>';
}
$output.='</div>';
$output_nav.=$output;
$output=$output_nav;
echo  $output;
?>