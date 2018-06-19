<?php
require 'connect.php';
if($_POST["action"] == "sta_select") {
$output = '';
$searchString=htmlspecialchars($_POST['searchString']);
$tablename=htmlspecialchars($_POST['tablename']);
$columnname=htmlspecialchars($_POST['columnname']);
$beans = R::getAll('SELECT krossdata.data, krossdata.raspred_id, raspred.raspred_name, krossdata.number, krossdata.sub_id, sub.sub_name, sub.id, type.type_name, krossdata.comment, area.area_name
FROM krossdata
INNER JOIN raspred ON krossdata.raspred_id = raspred.id
INNER JOIN sub ON krossdata.sub_id = sub.id
INNER JOIN type ON krossdata.type_id = type.id
INNER JOIN area ON krossdata.area_id = area.id
WHERE '.$tablename.'.'.$columnname.'=?', [ $searchString ]);

//echo $output;
$catalogBeans=R::getAll('SELECT catalog.id, sub.sub_name, catalog.vnutr, catalog.city, unit.unit_name, department.department_name, catalog.cabinet, filial.filial_name, catalog.visibility
FROM catalog
INNER JOIN sub ON catalog.sub_id = sub.id
INNER JOIN unit ON catalog.unit_id = unit.id
INNER JOIN department ON catalog.department_id = department.id
INNER JOIN filial ON catalog.filial_id = filial.id
WHERE '.$tablename.'.'.$columnname.'=?', [ $searchString ]);

if ($beans==null & $catalogBeans==null) {
	$output='';
	$output='<div class="alert alert-success">Значение <strong>'.$searchString.'</strong> не задействовано ни в Кроссовом журнале, ни в Справочнике. Удаление возможно.</div>';
} else {
	if ($beans==null){
		$output=''; $output='<br><h4>Данные кросса</h4><div class="alert alert-success">Значение <strong>'.$searchString.'</strong> в Кроссовом журнале не задействовано.</div>';
}
else {
	$output='<br><h4>Данные кросса</h4><div class="alert alert-danger">Привязано к данным. Попытка удаления приведет к установке значения <strong>'.$searchString.'</strong> в затрагиваемых данных на <strong>Не присвоено</strong>!
</div>';
}
if ($catalogBeans==null){$output.='<br><h4>Данные Справочника</h4><div class="alert alert-success">Значение <strong>'.$searchString.'</strong> в Каталоге не задействовано.</div>';}
else {
	$output.='<br><h4>Данные Справочника</h4><div class="alert alert-danger">Привязано к данным Каталога. Попытка удаления приведет к установке значения <strong>'.$searchString.'</strong> в затрагиваемых данных Каталога на <strong>Не присвоено</strong>!
</div>';
}
}

echo $output;
}

if($_POST["action"] == "sta_delete") {
$data=$_POST;
$tablename = $_POST["tablename"];
$idname = $_POST["idname"];
switch ($tablename) {
	case 'unit':
		R::exec("UPDATE catalog SET   catalog.unit_id =1 WHERE catalog.unit_id=$idname");
	break;
	case 'department':
		R::exec("UPDATE catalog SET   catalog.department_id =1 WHERE catalog.department_id=$idname");
	break;
	case 'filial':
		R::exec("UPDATE catalog SET   catalog.filial_id =1 WHERE catalog.filial_id=$idname");
	break;
	case 'rasperd':
		R::exec("UPDATE krossdata SET   krossdata.rasperd_id =1 WHERE krossdata.rasperd_id=$idname");
	break;
	case 'sub':
		R::exec("UPDATE catalog SET   catalog.sub_id =1 WHERE catalog.sub_id=$idname");
		R::exec("UPDATE krossdata SET   krossdata.sub_id =1 WHERE krossdata.sub_id=$idname");
	break;
	case 'type':
		R::exec("UPDATE krossdata SET   krossdata.type_id =1 WHERE krossdata.type_id=$idname");
	break;
	case 'area':
		R::exec("UPDATE krossdata SET   krossdata.area_id =1 WHERE krossdata.area_id=$idname");
	break;
	
	default:
		# code...
	break;
}
$beean=R::load($tablename, $idname);
R::trash($beean);
echo "Инфомация удалена";
}


if($_POST["action"] == "sta_execute") {
	$data=$_POST;
$tablename = $_POST["tablename"];
$columnname = $_POST["columnname"];
$newvalue = $_POST["newvalue"];
$idname = $_POST["idname"];
$name = $_POST["name"];
$modal = '';
$errors=array();
$output = '';
$message='';


if (($_POST["idname"])!=''){

// $message= '<div class="alert alert-danger" role="alert">TEST</div>';
//     echo ($message);
if (R::count($tablename, ''.$columnname.'=?', [$newvalue])>0) {
    $errors[]=$newvalue.' : Значение существует';
  }
if (empty($errors)) {
$value=R::load($tablename, $idname);
$value->$columnname=$newvalue;
R::store($value);
$message= '<div class="alert alert-info" role="alert">Обновили. Новое значение: '.$newvalue.'</div>';
// echo ($message);
lookoutput($tablename, $columnname, $name, $message);

} else
  {
    $message= '<div class="alert alert-danger" role="alert">Ошибка обновления: '.array_shift($errors).'</div>';
    // echo ($message);
    lookoutput($tablename, $columnname, $name, $message);
  }
  //echo ($message);
} 
elseif (isset($_POST["columnname"])) {

// $errors=array();
// $output = '';
// $message='';
if (R::count($tablename, ''.$columnname.'=?', [$newvalue])>0) {
    $errors[]=$newvalue.' : Значение существует';
  }
if (empty($errors)) {
$value=R::dispense($tablename);
$value->$columnname=$newvalue;
R::store($value);
$message= '<div class="alert alert-info" role="alert">Добавлено новое значение: '.$newvalue.'</div>';
// echo ($message);
lookoutput($tablename, $columnname, $name, $message);

} else
  {
    $message= '<div class="alert alert-danger" role="alert">Ошибка добавления новой записи: '.array_shift($errors).'</div>';
    // echo ($message);
    lookoutput($tablename, $columnname, $name, $message);
  }
//echo ($message);
}


}


function lookoutput($tablename, $columnname, $name, $message)
{
  $output='';
  $modal = '';



$beans=R::getAll( 'SELECT * FROM '.$tablename.'');

$output= '
       <div class="table-responsive" id="employee_table">
       <h3>Таблица '.$name.'</h3>
           <table class="table table-bordered table-hover header-fixed table-fixed">
           <thead>
                <tr>
                    <th>ID</th>
                     <th>'.$name.'</th>

                </tr>
                </thead>
                <tbody>';
foreach ($beans as $row) {
   $output .= '
                <tr>

                     <td>'.$row['id'].'</td>
                     <td><a href="#" onclick="updateStaData(this)" data-idname="'.$row['id'].'" data-value="'.$row[$columnname].'" data-idinput="'.$idinput.'" class="tablecolumn">'.$row[$columnname].'</a></td>
                </tr>
           ';
}
$output.= '  <!-- Modal -->
  <div class="myModal modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Результат обработки</h4>
        </div>
        <div class="modal-body">
          '.$message.'
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" onclick="closeMyModal()">Закрыть</button>
        </div>
      </div>
      
    </div>
  </div>';
echo($output);
//echo($modal);


// echo ($message);
}
?>