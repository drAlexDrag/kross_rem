<?php
require 'connect.php'; // подключаем скрипт
if($_POST["action"] == "catalog_fetch_red") {
 if(isset($_POST["data_id"]))
 {
 $catalogBeans=R::getAll('SELECT catalog.id, sub.sub_name, catalog.vnutr, catalog.city, unit.unit_name, department.department_name, catalog.cabinet, filial.filial_name, catalog.visibility
FROM catalog
INNER JOIN sub ON catalog.sub_id = sub.id
INNER JOIN unit ON catalog.unit_id = unit.id
INNER JOIN department ON catalog.department_id = department.id
INNER JOIN filial ON catalog.filial_id = filial.id
WHERE catalog.id = ?', [$_POST["data_id"]]);
foreach($catalogBeans as $row){
      echo json_encode($row);
  }
 }

}



if($_POST["action"] == "catalog_update") {
	$data=$_POST;
$errors=array();
$output = '';
$message='';
$catalogId=$data["catalogId"];

// $login = mysqli_real_escape_string($connect, $_POST["login_idred"]);

$subId=R::getCol('select id from sub where sub_name=?', [$data["catalogSub"]]);

if (empty($subId)){
  $sub=R::dispense('sub');
  $sub->sub_name=$data["catalogSub"];
  R::store($sub);
  $subId=R::getCol('select id from sub where sub_name=?', [$data["catalogSub"]]);
  $message.= '<br><div class="alert alert-info" role="alert">Имя абонента : '.'<p style="color: red">'.$data["catalogSub"].'</p>'.' Отсутствовало в базе, но было добавлено </div>';
}
$unitId=R::getCol('select id from unit where unit_name=?', [$data["catalogUnit"]]);
if (empty($unitId)){
  $unit=R::dispense('unit');
  $unit->unit_name=$data["catalogUnit"];
  R::store($unit);
  $unitId=R::getCol('select id from unit where unit_name=?', [$data["catalogUnit"]]);
  $message.= '<br><div class="alert alert-info" role="alert">Имя управления : '.'<p style="color: red">'.$data["catalogUnit"].'</p>'.' Отсутствовало в базе, но было добавлено </div>';
}
$departmentId=R::getCol('select id from department where department_name=?', [$data["catalogDepartment"]]);
if (empty($departmentId)){
  $department=R::dispense('department');
  $department->department_name=$data["catalogDepartment"];
  R::store($department);
  $departmentId=R::getCol('select id from department where department_name=?', [$data["catalogDepartment"]]);
  $message.= '<br><div class="alert alert-info" role="alert">Имя отдела/бюро : '.'<p style="color: red">'.$data["catalogDepartment"].'</p>'.' Отсутствовало в базе, но было добавлено </div>';
}
$filialId=R::getCol('select id from filial where filial_name=?', [$data["catalogFilial"]]);
if (empty($filialId)){
  $filial=R::dispense('filial');
  $filial->filial_name=$data["catalogFilial"];
  R::store($filial);
  $filialId=R::getCol('select id from filial where filial_name=?', [$data["catalogFilial"]]);
  $message.= '<br><div class="alert alert-info" role="alert">Имя филиала : '.'<p style="color: red">'.$data["catalogFilial"].'</p>'.' Отсутствовало в базе, но было добавлено </div>';
}

// $output=$subId[0];
// $output.=$unitId[0];
// $output.=$departmentId[0];
// $output.=$filialId[0];
// echo $output;


if (empty($data["catalogId"])){
    //Отсутствует catalogId делаем Insert
  $catalog=R::dispense('catalog');
  $catalog->vnutr=$data["catalogVnutr"];
  $catalog->cabinet=$data["catalogCabinet"];
  $catalog->visibility=$data["catalogVisibility"];
  $catalog->sub=R::load('sub', $subId[0]);
  $catalog->unit=R::load('unit', $unitId[0]);
  $catalog->department=R::load('department', $departmentId[0]);
  $catalog->filial=R::load('filial', $filialId[0]);
  R::store($catalog);
  $getinsertID=R::getinsertID();
  $catalogId=$getinsertID;

   $logcatalog=R::dispense('logcatalog');
  $logcatalog->catalog_id=$getinsertID;
  $logcatalog->sub=$data["catalogSub"];
  $logcatalog->vnutr=$data["catalogVnutr"];
  // $logcatalog->city=$catalogselect->city;
  $logcatalog->unit=$data["catalogUnit"];;
  $logcatalog->department=$data["catalogDepartment"];
  $logcatalog->cabinet=$data["catalogCabinet"];
  $logcatalog->filial=$data["catalogFilial"];
  $logcatalog->visibility=$data["catalogVisibility"];
  // $logcatalog->number=$catalogselect->number;
  $logcatalog->user=$data["login_idred"];
  $logcatalog->operation='Новый абонент';
  R::store($logcatalog);
  $data["catalogId"]=R::getInsertID();
  $message.= '<br><div class="alert alert-info" role="alert">Новый абонент добавлен в Справочник телефонов : <br>';
}
elseif(!empty($data["catalogId"])) {
  //Получаем catalogId делаем Update
  $catalogselect=R::load('catalog', $data["catalogId"]);
  $logcatalog=R::dispense('logcatalog');
  $logcatalog->catalog_id=$data["catalogId"];
  $logcatalog->sub=$catalogselect->sub['sub_name'];
  $logcatalog->vnutr=$catalogselect->vnutr;
  $logcatalog->city=$catalogselect->city;
  $logcatalog->unit=$catalogselect->unit['unit_name'];
  $logcatalog->department=$catalogselect->department['department_name'];
  $logcatalog->cabinet=$catalogselect->cabinet;
  $logcatalog->filial=$catalogselect->filial['filial_name'];
  $logcatalog->visibility=$catalogselect->visibility;
  // $logcatalog->number=$catalogselect->number;
  $logcatalog->user=$data["login_idred"];
  $logcatalog->operation='До Изменения в Справочнике';
  R::store($logcatalog);

  $catalogselect->vnutr=$data["catalogVnutr"];
  $catalogselect->cabinet=$data["catalogCabinet"];
  $catalogselect->visibility=$data["catalogVisibility"];
  $catalogselect->sub=R::load('sub', $subId[0]);
  $catalogselect->unit=R::load('unit', $unitId[0]);
  $catalogselect->department=R::load('department', $departmentId[0]);
  $catalogselect->filial=R::load('filial', $filialId[0]);
  R::store($catalogselect);
  $catalogselect=R::load('catalog', $data["catalogId"]);
  $logcatalog=R::dispense('logcatalog');
  $logcatalog->catalog_id=$data["catalogId"];
  $logcatalog->sub=$catalogselect->sub['sub_name'];
  $logcatalog->vnutr=$catalogselect->vnutr;
  $logcatalog->city=$catalogselect->city;
  $logcatalog->unit=$catalogselect->unit['unit_name'];
  $logcatalog->department=$catalogselect->department['department_name'];
  $logcatalog->cabinet=$catalogselect->cabinet;
  $logcatalog->filial=$catalogselect->filial['filial_name'];
  $logcatalog->visibility=$catalogselect->visibility;
  // $logcatalog->number=$catalogselect->number;
  $logcatalog->user=$data["login_idred"];
  $logcatalog->operation='После Изменения в Справочнике';
  R::store($logcatalog);
  $catalogId=$data["catalogId"];
  $message.= '<br><div class="alert alert-info" role="alert">Обновление абонента в Справочнике телефонов : <br>';
}


          $output .= '
           <label class="text-success">Результат обработки</label>';
          $output .= '<div class="table-responsive table-bordered" id="catalog_table">';
           $output .= OutputTheadCatalog();

$catalog = R::getAll('SELECT catalog.id, catalog.sub_id, catalog.unit_id, catalog.department_id, catalog.filial_id, sub.sub_name, catalog.vnutr, catalog.city, unit.unit_name, department.department_name, catalog.cabinet, filial.filial_name, catalog.visibility
FROM catalog
INNER JOIN sub ON catalog.sub_id = sub.id
INNER JOIN unit ON catalog.unit_id = unit.id
INNER JOIN department ON catalog.department_id = department.id
INNER JOIN filial ON catalog.filial_id = filial.id
WHERE catalog.id=?', [ $catalogId]);
          foreach($catalog as $row)
 {
  $output .=OutputTbodyCatalog($row);

           }
           $output .= '</table>';

echo $message;
echo $output;
/////////Проверка по журналам Кросса
if ($data["subIdUpdate"]==$subId[0]) {
  # code...
  // echo $data["subIdUpdate"];
  // echo $subId[0];
  // echo "Обновления имени не происходило";

} else {
  # code...
  // echo $data["subIdUpdate"].'<br>';
  // echo $subId[0];
  // echo "Обновления имени происходило";
    $updateDataKross=R::getAll('SELECT krossdata.id, krossdata.data, krossdata.number, krossdata.sub_id
FROM krossdata
INNER JOIN sub ON krossdata.sub_id = sub.id
WHERE  krossdata.sub_id =? AND krossdata.number=?', [ $data["subIdUpdate"], $data["catalogVnutr"] ]);

    foreach($updateDataKross as $row){
      $data = R::load( 'krossdata', $row["id"] );
      // $data = R::load( 'krossdata', $row ); //reloads our data
  $logkross=R::dispense('logkross');
  $logkross->data_id=$data->id;
  $logkross->data_name=$data->data;
  $logkross->raspred=$data->raspred['raspred_name'];
  $logkross->number=$data->number;
  $logkross->sub=$data->sub['sub_name'];
  $logkross->type=$data->type['type_name'];
  $logkross->comment=$data->comment;
  $logkross->area=$data->area['area_name'];
  $logkross->user=$_SESSION["login"];
  $logkross->operation="Даннные до изменения через справочник";
  R::store($logkross);
  $data->sub_id=$subId[0];
  R::store($data);

  $data = R::load( 'krossdata', $row["id"] );
  $logkross=R::dispense('logkross');
  $logkross->data_id=$data->id;
  $logkross->data_name=$data->data;
  $logkross->raspred=$data->raspred['raspred_name'];
  $logkross->number=$data->number;
  $logkross->sub=$data->sub['sub_name'];
  $logkross->type=$data->type['type_name'];
  $logkross->comment=$data->comment;
  $logkross->area=$data->area['area_name'];
  $logkross->user=$_SESSION["login"];
  $logkross->operation="Даннные после изменения через справочник";
  R::store($logkross);
    }
}
}
 ?>