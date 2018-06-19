<?php
require 'connect.php';
// require 'myfunction.php';
$output = '';
$dataPost=$_POST;
$length_number=strlen($dataPost['searchString']);
$outputsearch='<div class="alert alert-info">Строка поиска: '.$dataPost['searchString'].'</div>';
echo($outputsearch);
$areaQuery = R::getAll('SELECT area_name FROM area');
foreach($areaQuery as $row)
{

  $output="";
  $area=$row['area_name'];
  switch ($dataPost['paramPoisk']) {
    case "number":
    $beans = R::getAll('SELECT krossdata.data, krossdata.raspred_id, raspred.raspred_name, krossdata.number, krossdata.sub_id, sub.sub_name, sub.id, type.type_name, krossdata.comment, area.area_name
      FROM krossdata
      INNER JOIN sub ON krossdata.sub_id = sub.id
      INNER JOIN type ON krossdata.type_id = type.id
      INNER JOIN area ON krossdata.area_id = area.id
      INNER JOIN raspred ON krossdata.raspred_id = raspred.id
      WHERE area.area_name=? AND  length(krossdata.number)=? 
      AND ' .$dataPost['paramPoisk'].' LIKE ? ORDER BY raspred_id', [ $area, $length_number, '%' . $dataPost['searchString'] . '%' ]);
    break;
    default:
    $beans = R::getAll('SELECT krossdata.data, krossdata.raspred_id, raspred.raspred_name, krossdata.number, krossdata.sub_id, sub.sub_name, sub.id, type.type_name, krossdata.comment, area.area_name
      FROM krossdata
      INNER JOIN sub ON krossdata.sub_id = sub.id
      INNER JOIN type ON krossdata.type_id = type.id
      INNER JOIN area ON krossdata.area_id = area.id
      INNER JOIN raspred ON krossdata.raspred_id = raspred.id
      WHERE area.area_name=? AND ' .$dataPost['paramPoisk'].' LIKE ? ORDER BY number', [ $area, '%' . $dataPost['searchString'] . '%' ]);
    break;
  }
/////

  $output .= '<div class="table-responsive table-bordered" ><h4 style="color:blue">Информация по кроссу '.$area.'</h4>';
  $output .= TheadKrossdata();
  foreach($beans as $row)
  {
    $color=ColorType($row["type_name"]);
    $output .=TbodyKrossdata($row, $color);
  }

  if ($beans==null){$output='';}
  echo $output.='</tbody> </table></div>';

 }//по таблице площадок

////////////TTTT


                /////////////////////
                //ПРоверка наличия номера в каталоге
 $output='';
 switch ($dataPost['paramPoisk']) {
  case "number":
  $strlong=strlen($dataPost['searchString']);
  $catalogBeans=R::getAll('SELECT catalog.id, catalog.sub_id, sub.sub_name, catalog.vnutr, catalog.city, unit.unit_name, department.department_name, catalog.cabinet, filial.filial_name, catalog.visibility
    FROM catalog
    INNER JOIN sub ON catalog.sub_id = sub.id
    INNER JOIN unit ON catalog.unit_id = unit.id
    INNER JOIN department ON catalog.department_id = department.id
    INNER JOIN filial ON catalog.filial_id = filial.id
    WHERE vnutr LIKE ? AND length(catalog.vnutr)=?
    ORDER BY catalog.id', ['%' . $dataPost['searchString'] . '%', $length_number]);
  $output .='<div class="table-responsive table-bordered" ><h4>Информация в справочнике</h4>';
  $output .= OutputTheadCatalog();
  foreach($catalogBeans as $row)
  {
   //  if (($row["visibility"])=="1"){
   //   $output .=OutputTbodyCatalog($row);
   // } else {
    $output .=OutputTbodyCatalog($row);
  // }
}
$output .= '</tbody></table></div>';
if ($catalogBeans==null){
  $output=BeansNull($catalogBeans, $dataPost['searchString']);
}
echo $output;
break;
case "sub_name":
$catalogBeans=R::getAll('SELECT catalog.id, catalog.sub_id, sub.sub_name, catalog.vnutr, catalog.city, unit.unit_name, department.department_name, catalog.cabinet, filial.filial_name, catalog.visibility
  FROM catalog
  INNER JOIN sub ON catalog.sub_id = sub.id
  INNER JOIN unit ON catalog.unit_id = unit.id
  INNER JOIN department ON catalog.department_id = department.id
  INNER JOIN filial ON catalog.filial_id = filial.id
  WHERE sub.sub_name LIKE ? ORDER BY catalog.id', ['%' . $dataPost['searchString'] . '%']);
$output .='<div class="table-responsive table-bordered" ><h4>Информация в справочнике</h4>';
$output .= OutputTheadCatalog();
foreach($catalogBeans as $row)
{
 $output .=OutputTbodyCatalog($row);
}
$output .= '</tbody></table></div>';
if ($catalogBeans==null){
  $output=BeansNull($catalogBeans, $dataPost['searchString']);
}
echo $output;
break;
}
?>