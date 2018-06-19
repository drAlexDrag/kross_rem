<?php
require 'connect.php';
$searchString=$_POST["searchString"];
$paramPoisk=$_POST['paramPoisk'];
 if (isset($_POST["searchString"])) {
$output = '';
switch ($paramPoisk) {
  case "id":
$catalogBeans=R::getAll('SELECT catalog.id, sub.sub_name, catalog.vnutr, catalog.city, unit.unit_name, department.department_name, catalog.cabinet, filial.filial_name, catalog.visibility
FROM catalog
INNER JOIN sub ON catalog.sub_id = sub.id
INNER JOIN unit ON catalog.unit_id = unit.id
INNER JOIN department ON catalog.department_id = department.id
INNER JOIN filial ON catalog.filial_id = filial.id
WHERE catalog.id=? ', [$searchString]);
        break;
 case "sub":
        $catalogBeans=R::getAll('SELECT catalog.id, sub.sub_name, catalog.vnutr, catalog.city, unit.unit_name, department.department_name, catalog.cabinet, filial.filial_name, catalog.visibility
FROM catalog
INNER JOIN sub ON catalog.sub_id = sub.id
INNER JOIN unit ON catalog.unit_id = unit.id
INNER JOIN department ON catalog.department_id = department.id
INNER JOIN filial ON catalog.filial_id = filial.id
WHERE sub_name LIKE ?', ['%' . $searchString . '%']);
        break;
        default:
        $catalogBeans=R::getAll('SELECT catalog.id, catalog.sub_id, sub.sub_name, catalog.vnutr, catalog.city, unit.unit_name, department.department_name, catalog.cabinet, filial.filial_name, catalog.visibility
FROM catalog
INNER JOIN sub ON catalog.sub_id = sub.id
INNER JOIN unit ON catalog.unit_id = unit.id
INNER JOIN department ON catalog.department_id = department.id
INNER JOIN filial ON catalog.filial_id = filial.id
WHERE vnutr LIKE ? 
ORDER BY catalog.id', ['%' . $searchString . '%']);
        break;
        }

$output .= '<hr><h3>Информация в справочнике</h3>
  <div class="table-responsive table-bordered" id="catalog_table" >
            <table class="table table-bordered table-hover">
             
                <tr><thead>
                     <th>ID Абонента</th>
                     <th>Абонент</th>
                     <th>Внутренний</th>
                     
                     <th>Управление</th>
                     <th>Отдел/Бюро</th>
                     <th>Кабинет</th>
                     <th>Филиал</th>
                </tr></thead>';

foreach($catalogBeans as $row)
 {
if (($row["visibility"])=="1"){
 $output .= '
               <tbody> <tr>
                     <td class="red_modal  edit_catalog" data-sub="'.$row["sub_name"].'" data-id="'.$row["id"].'" data-subid="'.$row["sub_id"].'">'.$row["id"].'<span class="glyphicon glyphicon-edit"></span></td>
                     <!--td  class="feedback" data-id="'.$row["id"].'" style="background:  #CDC5BF">'.$row["sub"].'</td-->
                     <td data-sub="'.$row["sub_name"].'" data-subid="'.$row["sub_id"].'" data-catalogid="'.$row["id"].'" >'.$row["sub_name"].'</td>
                     <td class="data-number" data-idnumber="'.$row["vnutr"].'">'.$row["vnutr"].'</td>
                     <!--td>'.$row["city"].'</td-->
                     <td>'.$row["unit_name"].'</td>
                     <td>'.$row["department_name"].'</td>
                     <td>'.$row["cabinet"].'</td>
                     <td>'.$row["filial_name"].'</td>

                </tr>
           ';
         } else {
          $output .= '
               <tbody> <tr style="background:  #FF4500";>
                     <td class="red_modal  edit_catalog" data-sub="'.$row["sub_name"].'" data-id="'.$row["id"].'" data-subid="'.$row["sub_id"].'">'.$row["id"].'<span class="glyphicon glyphicon-edit"></span></td>
                     <!--td  class="feedback" data-id="'.$row["id"].'" style="background:  #CDC5BF">'.$row["sub"].'</td-->
                     <td data-sub="'.$row["sub_name"].'" data-subid="'.$row["sub_id"].'" data-catalogid="'.$row["id"].'">'.$row["sub_name"].'</td>
                     <td class="data-number" data-idnumber="'.$row["vnutr"].'">'.$row["vnutr"].'</td>
                     <!--td>'.$row["city"].'</td-->
                     <td>'.$row["unit_name"].'</td>
                     <td>'.$row["department_name"].'</td>
                     <td>'.$row["cabinet"].'</td>
                     <td>'.$row["filial_name"].'</td>

                </tr>
           ';
         }
 }
 $output .= '</tbody> </table></div>';
 if ($catalogBeans==null){
  $output=''; $output='<br><div class="alert alert-danger">
  Номер : <strong>'.$searchString.'</strong><br> Отсутствует в справочнике <br>';
  $getDataKross=R::getAll('SELECT krossdata.id, krossdata.data, krossdata.raspred_id, raspred.raspred_name, krossdata.number, krossdata.sub_id, sub.sub_name, sub.id, type.type_name, krossdata.comment, area.area_name
FROM krossdata
INNER JOIN sub ON krossdata.sub_id = sub.id
INNER JOIN type ON krossdata.type_id = type.id
INNER JOIN area ON krossdata.area_id = area.id
INNER JOIN raspred ON krossdata.raspred_id = raspred.id
WHERE  krossdata.number =?', [$searchString]);
  $output.= '
      <div class="table-responsive" style="border-color:blue; border-style: double; margin-top: 5px; border-radius: 10px;">
           <table class="table table-bordered table-hover">
           <h3 style="color:blue">Информация по кроссовому журналу</h3>
           <thead>
                <tr>
                     <th>Данные</th>
                     <th>Распределение</th>
                     <th>Номер</th>
                     <th>Имя</th>
                     <th>Тип</th>
                     <th>Комментарии</th>
                     <th>Имя по Кроссам</th>
                     <th>Площадка</th>
                </tr>';
  foreach($getDataKross as $row){
    
    //$outputUpdate='<br>'.$row['number'];
      $color=ColorType($row["type_name"]);
          $output.= '
                <tr '.$color.'>
                     <td><b>'.$row["data"].' </b></td>
                     <td>'.$row["raspred_name"].'</td>
                     <td>'.$row["number"].'</td>
                     <td class="catalogNumberAdd" data-number="'.$searchString.'" data-sub="'.$row["sub_name"].'"><b>'.$row["sub_name"].'</b> <span class="glyphicon glyphicon-plus-sign"></span></td>
                     <td>'.$row["type_name"].'</td>
                     <td>'.$row["comment"].'</td>
                     <td>'.$row["name_xxx"].'</td>
                     <td>'.$row["area_name"].'</td>
                </tr>
                ';
  }
  $output.='</tbody> </table></div><br>';
  // $output.='<button type="button" onclick="catalogNumberAdd('.$searchString.')" class="btn btn-success" >Добавить номер в Справочник</button>';
  $output.='</div>';
}


   }
 
 echo $output;
 ?>