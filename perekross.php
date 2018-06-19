<?php
require "connect.php";
require_once "phpdebug/phpdebug.php";//вывод в консоль
// require 'myfunction.php';
if($_POST["action"] == "pereKross"){
	$output ='';
	$inData=array();
$data = R::load( 'krossdata', $_POST['dataId'] ); //reloads our data
$inData=[
	"data_id"=>$data->id,
	"data_name"=>$data->data,
	"raspred"=>$data->raspred['raspred_name'],
	"number"=>$data->number,
	"sub"=>$data->sub['sub_name'],
	"type"=>$data->type['type_name'],
	"comment"=>$dataComment,
	"area"=>$data->area['area_name'],
	"areaId"=>$data->area['id'],
];

$outputIn.='<div class="table-responsive" style="border-color:blue; border-style: double; margin-top: 5px; border-radius: 10px;" name="pereKrossIn" id="pereKrossIn" data-controlArea="'.$inData["areaId"].'" data-dataid="'.$inData["data_id"].'">
<table class="table table-bordered table-hover">
<thead>
<tr>
<th>Данные</th>
<th>Распределение</th>
<th>Номер</th>
<th>Имя</th>
<th>Тип</th>
<th>Комментарии</th>
<th>Площадка</th>
</tr></thead>
<tbody>';
$color=ColorType($inData["type"]);
$outputIn.='<tr '.$color.'>
<td>'.$inData['data_name'].'</td>
<td>'.$inData['raspred'].'</td>
<td>'.$inData['number'].'</td>
<td>'.$inData['sub'].'</td>
<td>'.$inData['type'].'</td>
<td>'.$inData['comment'].'</td>
<td>'.$inData['area'].'</td>
</tr></tbody></table></div>
';

$output.='<div class="alert alert-info"><h4>Данные для перекроссировки</h4>'.$outputIn.'</div>
<div class="alert alert-info"><h4>Перекроссировать или скопировать на данные</h4><input type="text" name="dataSearch" id="dataSearch" class="form-control pereKross" placeholder="На какие данные переносим или копируем?">
<div name="pereKross" id="pereKross"></div>
</div>
';
echo $output;
}

if($_POST["action"] == "search_pereKross"){
	$outputOut="";
	$getDataId =R::getRow( 'SELECT * FROM krossdata WHERE area_id=? AND data=?', [ $_POST['areaId'], $_POST['dataName'] ]);
	$dataId=$getDataId["id"];
$data = R::load( 'krossdata', $dataId ); //reloads our data
$outData=[
	"data_id"=>$data->id,
	"data_name"=>$data->data,
	"raspred"=>$data->raspred['raspred_name'],
	"number"=>$data->number,
	"sub"=>$data->sub['sub_name'],
	"type"=>$data->type['type_name'],
	"comment"=>$dataComment,
	"area"=>$data->area['area_name'],
];
$outputOut.='
<div class="table-responsive" style="border-color:blue; border-style: double; margin-top: 5px; border-radius: 10px;" name="pereKrossOut" id="pereKrossOut" data-dataid="'.$outData["data_id"].'">
<table class="table table-bordered table-hover">
<thead>
<tr>
<th>Данные</th>
<th>Распределение</th>
<th>Номер</th>
<th>Имя</th>
<th>Тип</th>
<th>Комментарии</th>
<th>Площадка</th>
</tr></thead>
<tbody>';
$color=ColorType($outData["type"]);
$outputOut.='<tr '.$color.'>
<td>'.$outData['data_name'].'</td>
<td>'.$outData['raspred'].'</td>
<td>'.$outData['number'].'</td>
<td>'.$outData['sub'].'</td>
<td>'.$outData['type'].'</td>
<td>'.$outData['comment'].'</td>
<td>'.$outData['area'].'</td>
</tr></tbody></table></div>
<hr>
<div class="col-md-6" style="bottom: 10px"><button type="button" class="btn btn-danger btn-block" onclick="cPereKross(\'confirm_pereKross\')" name="confirmPereKross" id="confirmPereKross"><!--span class="glyphicon glyphicon-random"></span-->Выполнить перекроссировку</button></div>
<div class="col-md-6" style="bottom: 10px"><button type="button" class="btn btn-warning btn-block" onclick="cPereKross(\'copy_pereKross\')" name="copyPereKross" id="copyPereKross">Выполнить копирование данных</button></div><hr>
';

} 
echo $outputOut;

if($_POST["action"] == "confirm_pereKross"){

	$dataOut=$_POST['dataOut'];

	$data = R::load( 'krossdata', $_POST['dataIn'] );
	$inData=[
		"data_id"=>$data->id,
		"data_name"=>$data->data,
		"raspred"=>$data->raspred_id,
		"number"=>$data->number,
		"sub"=>$data->sub_id,
		"type"=>$data->type_id,
		"comment"=>$data->comment,
		"area"=>$data->area_id,
	];
	if ($_POST['dataOut']==0) {
		$datareturn=NewData($inData["area"], $dataOut);
		$dataOut=$datareturn["dataOut"];
		

		$outputPereKross.=$datareturn["outputPereKross"];
	} 
		# code...
		$data = R::load( 'krossdata', $dataOut );
		$outData=["data_name"=>$data->data];
		$data->raspred_id=$inData["raspred"];
		$data->number=$inData["number"];
		$data->sub_id=$inData["sub"];
		$data->type_id=$inData["type"];
		$data->comment=$inData["comment"];
		R::store($data);
		$data = R::load( 'krossdata', $_POST['dataIn'] );
		$data->number="";
		$data->sub_id="1";
		$data->type_id="8";
		$data->comment="";
		R::store($data);
		$outputPereKross.='<div class="alert alert-info"><h3>Информация по номеру <strong class="data-number" data-idnumber="'.$inData["number"].'">'.$inData["number"].'<span class="glyphicon glyphicon-search"></span></strong> была перемещена:</h3>с данных № <strong style="font-size:25px">'.$inData["data_name"].'</strong><br>на данные № <strong style="font-size:25px">'.$outData["data_name"].'</strong></div>';

		//log
		$data = R::load( 'krossdata', $dataOut ); //reloads our data
		$logkross=R::dispense('logkross');
		$logkross->data_id=$dataOut;
		// $logkross->data_id=$data->id;
		$logkross->data_name=$data->data;
		$logkross->raspred=$data->raspred['raspred_name'];
		$logkross->number=$data->number;
		$logkross->sub=$data->sub['sub_name'];
		$logkross->type=$data->type['type_name'];
		$logkross->comment=$data->comment;
		$logkross->area=$areaName;
		$logkross->user=$_SESSION["login"];
		$logkross->operation='Перекроссировка '.$inData["data_name"].'>'.$outData["data_name"].'';
		R::store($logkross);


	
}

if($_POST["action"] == "copy_pereKross"){
	$data = R::load( 'krossdata', $_POST['dataIn'] );
	$dataOut=$_POST['dataOut'];
	$inData=[
		"data_id"=>$data->id,
		"data_name"=>$data->data,
		"raspred"=>$data->raspred_id,
		"number"=>$data->number,
		"sub"=>$data->sub_id,
		"type"=>$data->type_id,
		"comment"=>$data->comment,
		"area"=>$data->area_id,
	];
		if ($_POST['dataOut']==0) {
		$datareturn=NewData($inData["area"], $dataOut);
		$dataOut=$datareturn["dataOut"];
		$outputPereKross.=$datareturn["outputPereKross"];
	}
	// var_dump($dataOut); 
	$data = R::load( 'krossdata', $dataOut );
	$outData=["data_name"=>$data->data];
	$data->raspred_id=$inData["raspred"];
	$data->number=$inData["number"];
	$data->sub_id=$inData["sub"];
	$data->type_id=$inData["type"];
	$data->comment=$inData["comment"];
	R::store($data);
	$outputPereKross.='<div class="alert alert-info"><h3>Информация по номеру <strong class="data-number" data-idnumber="'.$inData["number"].'">'.$inData["number"].'<span class="glyphicon glyphicon-search"></span></strong> была скопирована:</h3>с данных № <strong style="font-size:25px">'.$inData["data_name"].'</strong><br>на данные № <strong style="font-size:25px">'.$outData["data_name"].'</strong></div>';
	$data = R::load( 'krossdata', $_POST['dataIn'] ); //reloads our data
		$logkross=R::dispense('logkross');
		$logkross->data_id=$dataOut;
		// $logkross->data_id=$data->id;
		$logkross->data_name=$data->data;
		$logkross->raspred=$data->raspred['raspred_name'];
		$logkross->number=$data->number;
		$logkross->sub=$data->sub['sub_name'];
		$logkross->type=$data->type['type_name'];
		$logkross->comment=$data->comment;
		$logkross->area=$areaName;
		$logkross->user=$_SESSION["login"];
		$logkross->operation='Копирование '.$inData["data_name"].'>'.$outData["data_name"].'';
		R::store($logkross);
}
function NewData($area, $dataOut)
{
	$debug = new PHPDebug();
	$debug->debug("NewData(area, dataOut)", null, LOG);
		$data=R::dispense('krossdata');
		$debug->debug($_POST['dataSearch'], null, LOG);
		$data->data=$_POST['dataSearch'];
		$data->raspred_id="1";
		$data->sub_id="1";
		$data->type_id="8";
		$data->area_id=$area;
		$debug->debug($area, null, LOG);
		R::store($data);
		$dataOut=R::getinsertID();
		$outputPereKross.= '<div class="alert alert-info" role="alert">Площадка: <strong style="font-size:25px">'.$_POST['areaName'].'</strong><hr>Добавлены новые данные: <strong style="font-size:25px">'.$_POST['dataSearch'].'</strong></div>';
		return array('dataOut' => $dataOut, 'outputPereKross' => $outputPereKross);
}
echo $outputPereKross;
?>