<?php
// Файл обработки данных в таблице кросса
require 'connect.php'; // подключаем скрипт
if($_POST["action"] == "data_execute"){
$dataPost=$_POST;//Весь пост в массив data
$errors=array();
$output = '';
$message = '';
$dataKross=$_POST['dataKross'];
$dataRaspred=$_POST['dataRaspred'];
$dataNumber=$_POST['dataNumber'];
$dataSub=$_POST['dataSub'];
$previousSubId=$_POST['previousSubId'];
$dataType=$_POST['dataType'];
$dataComment=$_POST['dataComment'];
$areaName=$_POST['areaName'];
$loginName=$_POST['loginName'];
$dataId=$_POST['dataId'];

$raspredId=$_POST['raspredId'];
$subId=$_POST['subId'];
$typeId=$_POST['typeId'];
$areaId=$_POST['areaId'];

$message.='<br><label class="text-success">Результат обработки</label>';

if (empty($dataId)) {
  // Проверяем наличие данных на площадке(по id данных), если данные отсутствуют на площадке -> Добавляем
	$data=R::dispense('krossdata');
	$data->data=$dataKross;
	$data->number=$dataNumber;
	$data->comment=$dataComment;
	$data->raspred=R::load('raspred', $raspredId);
	$data->sub=R::load('sub', $subId);
	$data->type=R::load('type', $typeId);
	$data->area=R::load('area', $areaId);
	R::store($data);
  $getinsertID=R::getinsertID();
	$message.= '<div class="alert alert-info" role="alert">Площадка: <strong>'.$areaName.'</strong><hr>Добавлены новые данные: <strong>'.$dataKross.'</strong></div>';
  $headertable="Добавлены новые данные";
  // R::exec( "SET @user_login='$loginName', @operation='Новая запись'");
  // После добавления данных делаем запись в log файл
  $logkross=R::dispense('logkross');
  $logkross->data_id=$getinsertID;
  $logkross->data_name=$dataKross;
  $logkross->raspred=$dataRaspred;
  $logkross->number=$dataNumber;
  $logkross->sub=$dataSub;
  $logkross->type=$dataType;
  $logkross->comment=$dataComment;
  $logkross->area=$areaName;
  $logkross->user=$loginName;
  $logkross->operation="Новая запись";
  R::store($logkross);
	// $output = 'Добавляем';
	// echo($output);
} else {
  // если данные отсутствуют на площадке -> Изменяем
	$data = R::load( 'krossdata', $dataId ); //reloads our data
  // Вносим в log файл старые данные
  $logkross=R::dispense('logkross');
  $logkross->data_id=$data->id;
  $logkross->data_name=$data->data;
  $logkross->raspred=$data->raspred['raspred_name'];
  $logkross->number=$data->number;
  $logkross->sub=$data->sub['sub_name'];
  $logkross->type=$data->type['type_name'];
  $logkross->comment=$data->comment;
  $logkross->area=$areaName;
  $logkross->user=$loginName;
  $logkross->operation="Даннные до изменения";
  R::store($logkross);
  // Изменяем данные
	$data->number=$dataNumber;
	$data->comment=$dataComment;
	$data->raspred=R::load('raspred', $raspredId);
	$data->sub=R::load('sub', $subId);
	$data->type=R::load('type', $typeId);
  //$data=$data->type;//??????????????????????

  
	$data->area=R::load('area', $areaId);
	R::store($data);
  $data = R::load( 'krossdata', $dataId ); //reloads our data
  // // После изменения данных делаем запись в log файл
  $logkross=R::dispense('logkross');
  $logkross->data_id=$data->id;
  $logkross->data_name=$data->data;
  $logkross->raspred=$data->raspred['raspred_name'];
  $logkross->number=$data->number;
  $logkross->sub=$data->sub['sub_name'];
  $logkross->type=$data->type['type_name'];
  $logkross->comment=$dataComment;
  $logkross->area=$areaName;
  $logkross->user=$loginName;
  $logkross->operation="Даннные после изменения";
  R::store($logkross);
	$message.= '<div class="alert alert-info" role="alert">Площадка: <strong>'.$areaName.'</strong><hr>Данные: <strong>'.$dataKross.'</strong> обновлены</div>';
  $headertable="Обновленные данные";
  if ($subId != $previousSubId) {
    $idDataKross=R::getCol('SELECT id FROM krossdata WHERE krossdata.number=? AND krossdata.sub_id=?', [$dataNumber, $previousSubId]);
    foreach ($idDataKross as $row) {
      $data = R::load( 'krossdata', $row ); //reloads our data
  $logkross=R::dispense('logkross');
  $logkross->data_id=$data->id;
  $logkross->data_name=$data->data;
  $logkross->raspred=$data->raspred['raspred_name'];
  $logkross->number=$data->number;
  $logkross->sub=$data->sub['sub_name'];
  $logkross->type=$data->type['type_name'];
  $logkross->comment=$data->comment;
  $logkross->area=$data->area['area_name'];
  $logkross->user=$loginName;
  $logkross->operation="Даннные до изменения";
  R::store($logkross);
  $data->sub=R::load('sub', $subId);
  R::store($data);
  $data = R::load( 'krossdata', $row ); //reloads our data
  $logkross=R::dispense('logkross');
  $logkross->data_id=$data->id;
  $logkross->data_name=$data->data;
  $logkross->raspred=$data->raspred['raspred_name'];
  $logkross->number=$data->number;
  $logkross->sub=$data->sub['sub_name'];
  $logkross->type=$data->type['type_name'];
  $logkross->comment=$dataComment;
  $logkross->area=$areaName;
  $logkross->user=$loginName;
  $logkross->operation="Даннные после изменения";
  R::store($logkross);
      # code...
    }
 }
	// $output = 'Обновление';
	// echo($output);
}

echo($message);
$areaQuery = R::getAll('SELECT area_name FROM area');
foreach($areaQuery as $row)
{
  $area=$row['area_name'];
$idDataKross=R::getCol('SELECT id FROM krossdata WHERE data=? AND area_id=?', [$dataKross, $areaId]);
	$updateDataKross=R::getAll('SELECT krossdata.id, krossdata.data, krossdata.raspred_id, raspred.raspred_name, krossdata.number, krossdata.sub_id, sub.sub_name, sub.id, type.type_name, krossdata.comment, area.area_name
FROM krossdata
INNER JOIN sub ON krossdata.sub_id = sub.id
INNER JOIN type ON krossdata.type_id = type.id
INNER JOIN area ON krossdata.area_id = area.id
INNER JOIN raspred ON krossdata.raspred_id = raspred.id
WHERE  krossdata.sub_id =? AND krossdata.number=? AND area.area_name=?', [ $subId, $dataNumber, $area]);
$outputUpdate='';
	//echo($updateDataKross);
$outputUpdate .= '<div class="table-responsive table-bordered"><h3 style="color:blue">'.$headertable.' по '.$area.'</h3>';
  $outputUpdate .= TheadKrossdata();
	foreach($updateDataKross as $row){
		
		//$outputUpdate='<br>'.$row['number'];
		  $color=ColorType($row["type_name"]);
          $outputUpdate .=TbodyKrossdata($row, $color);
	}
	$outputUpdate.='</tbody></table></div>';
  if ($updateDataKross==null){$outputUpdate='';}
	echo($outputUpdate);
}

//Обновляем информацию по номеру в каталоге (ПРИ НАЛИЧИИ ТАКОГО НОМЕРА)
	$catalog = R::getAll('SELECT catalog.id, sub.sub_name, catalog.vnutr, catalog.city, unit.unit_name, department.department_name, catalog.cabinet, filial.filial_name, catalog.visibility
	FROM catalog
	INNER JOIN sub ON catalog.sub_id = sub.id
	INNER JOIN unit ON catalog.unit_id = unit.id
	INNER JOIN department ON catalog.department_id = department.id
	INNER JOIN filial ON catalog.filial_id = filial.id
	WHERE sub.id=? and catalog.vnutr=? ORDER BY catalog.id', [$previousSubId, $dataNumber]);
	// WHERE sub.sub_name=? and catalog.vnutr=? ORDER BY catalog.id', [$previousSub, $dataNumber]);
	$outputcatalog='';
	$outputcatalog='Обновление записей по справочнику';
	if ($catalog==null){$outputcatalog=''; $outputcatalog='<br><div class="alert alert-danger">
	Номер : <strong>'.$dataNumber.'</strong> привязаный к абоненту  отсутствует в справочнике</div>';}
  // Номер : <strong>'.$dataNumber.'</strong> привязаный к абоненту '.$previousSub.' отсутствует в справочнике</div>';}


  else{


	foreach($catalog as $row)
	{
 	//$prsubId=R::getCol('select id from sub where sub_name=?', [$dataSub]);
	$catalogselect=R::load('catalog', $row['id']);
  $logcatalog=R::dispense('logcatalog');
  $logcatalog->catalog_id=$row['id'];
  $logcatalog->sub=$catalogselect->sub['sub_name'];
  $logcatalog->vnutr=$catalogselect->vnutr;
  $logcatalog->city=$catalogselect->city;
  $logcatalog->unit=$catalogselect->unit['unit_name'];
  $logcatalog->department=$catalogselect->department['department_name'];
  $logcatalog->cabinet=$catalogselect->cabinet;
  $logcatalog->filial=$catalogselect->filial['filial_name'];
  $logcatalog->visibility=$catalogselect->visibility;
  // $logcatalog->number=$catalogselect->number;
  $logcatalog->user=$loginName;
  $logcatalog->operation='До Изменения имени через кроссовый журнал';
  R::store($logcatalog);
	// $catalogselect->number=$dataNumber;
	$catalogselect->sub=R::load('sub', $subId);
	R::store($catalogselect);
  $catalogselect=R::load('catalog', $row['id']);
  $logcatalog=R::dispense('logcatalog');
  $logcatalog->catalog_id=$row['id'];
  $logcatalog->sub=$catalogselect->sub['sub_name'];
  $logcatalog->vnutr=$catalogselect->vnutr;
  $logcatalog->city=$catalogselect->city;
  $logcatalog->unit=$catalogselect->unit['unit_name'];
  $logcatalog->department=$catalogselect->department['department_name'];
  $logcatalog->cabinet=$catalogselect->cabinet;
  $logcatalog->filial=$catalogselect->filial['filial_name'];
  $logcatalog->visibility=$catalogselect->visibility;
  // $logcatalog->number=$catalogselect->number;
  $logcatalog->user=$loginName;
  $logcatalog->operation='После Изменения имени через кроссовый журнал';
  R::store($logcatalog);
	// $outputcatalog.='<br>#'.$row['id'];
	$outputcatalog.='<div class="alert alert-info">Запись ID: <strong>#'.$row['id'].'</strong> обновлена в справочнике</div>';
	}
            $outputcatalog.= '
           <label class="text-success">Результат обработки</label>';
          $outputcatalog.= '<div class="table-responsive table-bordered" id="catalog_table">';
          $outputcatalog.=OutputTheadCatalog();

$catalog = R::getAll('SELECT catalog.id, catalog.sub_id, catalog.unit_id, catalog.department_id, catalog.filial_id, sub.sub_name, catalog.vnutr, catalog.city, unit.unit_name, department.department_name, catalog.cabinet, filial.filial_name, catalog.visibility
FROM catalog
INNER JOIN sub ON catalog.sub_id = sub.id
INNER JOIN unit ON catalog.unit_id = unit.id
INNER JOIN department ON catalog.department_id = department.id
INNER JOIN filial ON catalog.filial_id = filial.id
WHERE sub.id=? and catalog.vnutr=? ORDER BY catalog.id', [$subId, $dataNumber]);
          foreach($catalog as $row)
 {
$outputcatalog .=OutputTbodyCatalog($row);

           }
           $outputcatalog.= '</tbody></table></div>';
    }
	echo($outputcatalog);
}


if($_POST["action"] == "data_autosearch"){
  // Проверка данных на наличие по площадке
  if(isset($_POST["dataKross"]))
{
  $output = '';
  $areaName =htmlspecialchars ($_POST["areaName"]);
  $dataKross =htmlspecialchars ($_POST["dataKross"]);
  $beans = R::getAll('SELECT krossdata.data, krossdata.raspred_id, krossdata.number, sub.sub_name, type.type_name, krossdata.comment, area.area_name, sub.id
    FROM krossdata
    INNER JOIN raspred ON krossdata.raspred_id=raspred.id
    INNER JOIN sub ON krossdata.sub_id = sub.id
    INNER JOIN type ON krossdata.type_id = type.id
    INNER JOIN area ON krossdata.area_id = area.id
    WHERE krossdata.data=? AND area.area_name=?', [ $dataKross, $areaName ]);


  foreach($beans as $row)
  {
    // if(strlen($row['number'])==0){
    //   $output .= '<li><div class="alert alert-danger" role="alert">Данные '.$dataKross.' по '.$areaName.' добавить повторно невозможно. Можно изменить только в режиме редактирования</div></li>';
    // }
    // else{ $output .= '<li><div class="alert alert-danger" role="alert">Данные '.$dataKross.' по '.$areaName.' привязаны к номеру '.$row['number'].'. <p style="color: red;">Необходимо указать другие данные или изменить '.$dataKross.' в режиме редактирования</p></div></li>';}

    }
    if ($beans==null) {
      $output .= '<div class="alert alert-success" role="alert">Данные '.$dataKross.' отсутствуют в базе '.$areaName.' и могут быть добавлены</div>';
    } else{
      $output .= '<div class="alert alert-danger" role="alert" id="dangeralert">Данные '.$dataKross.' по '.$areaName.' добавить повторно невозможно. Можно изменить только в режиме редактирования</div>';
    }
    $output .= '';


    echo $output;
  }



//Провеяем на каких еще данных висит номер
  if(isset($_POST["querynumber"]))
  {
    $output = '';
    $dataNumber =htmlspecialchars ($_POST["querynumber"]);

    $beans = R::getAll('SELECT krossdata.data, krossdata.raspred_id, raspred.raspred_name, krossdata.number, sub.id, sub.sub_name, type.type_name, krossdata.comment, area.area_name
      FROM krossdata
      INNER JOIN raspred ON krossdata.raspred_id=raspred.id
      INNER JOIN sub ON krossdata.sub_id = sub.id
      INNER JOIN type ON krossdata.type_id = type.id
      INNER JOIN area ON krossdata.area_id = area.id
      WHERE krossdata.number=? ORDER BY  raspred_id', [$dataNumber]);
    $output = '<ul class="list-unstyled">';

    foreach($beans as $row){
      $output .= '<li><div class="alert alert-info col-sm-6" role="alert">Номер привязан к следующим данным <strong>'.$row['data'].'</strong>/Распределение '.$row['raspred_name'].'/'.$row['sub_name'].'/'.$row['area_name'].'</div></li>';
    }

    if ($beans==null){$output=''; $output .= '<li>Номер отсутствует в базе</li>';}
    $output .= '</ul>';
    echo $output;
  }
}

if($_POST["action"] == "data_fetch") {
   if(isset($_POST["data_id"]))
 {
  $beans = R::getAll('SELECT krossdata.id, krossdata.data, krossdata.raspred_id, raspred.raspred_name, krossdata.number, krossdata.sub_id, sub.sub_name, krossdata.type_id, type.type_name, krossdata.comment, krossdata.area_id, area.area_name
FROM krossdata
INNER JOIN sub ON krossdata.sub_id = sub.id
INNER JOIN type ON krossdata.type_id = type.id
INNER JOIN area ON krossdata.area_id = area.id
INNER JOIN raspred ON krossdata.raspred_id = raspred.id
WHERE krossdata.data=?  AND area.area_name=?', [$_POST["data_id"], $_POST["area"]]);
  foreach($beans as $row){
      echo json_encode($row);
    }
 }
}
if($_POST["action"] == "data_clear"){
  // Очищаем данные
  $dataId=$_POST['dataId'];
  $areaId=$_POST['areaId'];
  $loginName=$_POST['loginName'];
  $typeSelectId=$_POST['typeSelectId'];
  $typeSelectName=$_POST['typeSelectName'];
$data=R::load('krossdata', $dataId);
$logkross=R::dispense('logkross');
  $logkross->data_id=$data->id;
  $logkross->data_name=$data->data;
  $logkross->raspred=$data->raspred['raspred_name'];
  $logkross->number=$data->number;
  $logkross->sub=$data->sub['sub_name'];
  $logkross->type=$data->type['type_name'];
  $logkross->comment=$data->comment;
  $logkross->area=$data->area['area_name'];
  $logkross->user=$loginName;
  $logkross->operation="Даннные до очистки";
  R::store($logkross);
  // $data->data=$dataKross;
  $dataname=$data->data;
  $data->number='';
  $data->comment='';
  $data->raspred=R::load('raspred', 1);
  $data->sub=R::load('sub', 1);
  $data->type=R::load('type', $typeSelectId);
  // $data->area=R::load('area', $areaId);
  R::store($data);
  $out="";
  $out.='<div class="alert alert-danger" role="alert" id="dangeralert">Даннные <strong style="font-size:25px">'.$dataname.'</strong> очищены и помечены как <strong style="font-size:25px">'.$typeSelectName.'</strong></div>';
  echo $out;
}
?>