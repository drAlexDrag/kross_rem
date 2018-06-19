<?php
require_once 'tconnect.php';
if(isset($_POST["sector_id"]))
 {
 	$department_id=$_POST["department_id"];
  $department_name=$_POST["department_name"];
  $unit_name=$_POST["unit_name"];
  $unit_id=$_POST["unit_id"];
  $sector_id=$_POST["sector_id"];
  $sector_name=$_POST["sector_name"];

 
 $output_sector = '';
 $output = '';
 $output_nav = '';
 $beans = R::getAll('SELECT catalog.id, sub.sub_name, catalog.vnutr, catalog.city, unit.unit_name, department.department_name, sector.sector_name, catalog.cabinet, filial.filial_name, catalog.visibility, catalog.weight
FROM catalog
INNER JOIN sub ON catalog.sub_id = sub.id
INNER JOIN unit ON catalog.unit_id = unit.id
INNER JOIN department ON catalog.department_id = department.id
INNER JOIN sector ON catalog.sector_id = sector.id
INNER JOIN filial ON catalog.filial_id = filial.id
WHERE department.id=? AND unit.id=? AND sector.id=? AND visibility NOT IN ("0") ORDER BY weight DESC', [$department_id, $unit_id, $sector_id]);

 $output_nav .= '
 <div class="sector">
 <a href="#" onclick="loadData(1)"><span>Справочник телефонов <span class="glyphicon glyphicon-forward"></span></a>
 <a onclick="unitCatalog(this)" id="'.$unit_name.'" name="'.$unit_name.'" href="#" data-name="'.$unit_name.'"><span>'.$unit_name.' <span class="glyphicon glyphicon-forward"></span></span></a>

<a onclick="departmentCatalog(this)" href="#" id="'.$department_id.'" data-depname="'.$department_name.'" data-name="'.$unit_name.'" data-unitid="'.$unit_id.'"><span>'.$department_name.' <span class="glyphicon glyphicon-forward"></span></span></a>

 <a href="#" class=" alert alert-info" style="color:blue; pointer-events: none">'.$sector_name.'</a></div><hr>';
  $output_sector .= '<div class="table-responsive" >
           <table class="table table-bordered table-hover">
                <tr>
                     <th></th>
                     <th>Абонент</th>
                     <th>Телефон</th>
                     <!--th>Городской</th>
                     <th>Управление</th>
                     <th>Отдел/Бюро</th-->
                     <!--th>Кабинет</th-->
                     <th>Филиал</th>
                     <th>Вверх</th>
                     <th>Вниз</th>
                     <th>Вес</th>
                </tr>';
foreach($beans as $row)
 {
           $output_sector .= '
                <tr><td><div class="radio">
  <label><input type="radio" name="rbsel" id="'.$row["vnutr"].'" onclick="rbSelect('.$row["vnutr"].')"></label>
</div></td>
                     <td class="info">'.$row["sub_name"].'</td>
                     <td>'.$row["vnutr"].'</td>
                     <!--td>'.$row["city"].'</td-->';
                    //  <td>'.$row["unit_name"].'</td>';
                    // if (($row["department_name"])==NULL) {
                    //   $output_department .= '<td>'.$row["unit_name"].'</td>';
                    //  }
                    //  else {
                    //   $output_department .= '<td>'.$row["department_name"].'</td>';
                    //  }
            $output_sector .= '
<!--td>'.$row["cabinet"].'</td-->
<td>'.$row["filial_name"].'</td>

<td align="center"><button class="updown updown'.$row["vnutr"].'" id="upTree'.$row["vnutr"].'" data-action="upTree" data-name="'.$unit_name.'" data-id="'.$row["id"].'" data-depid="'.$department_id.'" data-depname="'.$department_name.'" data-unitid="'.$unit_id.'" data-sectorid="'.$sector_id.'" data-sectorname="'.$sector_name.'" data-unitdep="sec" hidden><span class="glyphicon glyphicon-arrow-up"></button></td>

   <td align="center"><button class="updown updown'.$row["vnutr"].'" id="downTree'.$row["vnutr"].'" data-action="downTree" data-name="'.$unit_name.'" data-id="'.$row["id"].'" data-depid="'.$department_id.'" data-depname="'.$department_name.'" data-unitid="'.$unit_id.'" data-sectorid="'.$sector_id.'" data-sectorname="'.$sector_name.'" data-unitdep="sec"" hidden><span class="glyphicon glyphicon-arrow-down"></span></button></td>
   <td>'.$row["weight"].'</td>
   </tr>
           ';
         }
 $output_sector .= '</table></div>';

}

$output_nav .=$output_sector;
$output_sector=$output_nav;
echo  $output_sector;
?>