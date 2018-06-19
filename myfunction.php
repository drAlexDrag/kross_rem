<?php
// маркировка типов данных по цветам
function ColorType($type)
{
	switch ($type) {
		case 'Прямая':
		$color='class="w3-aqua"';
		break;
		case 'Сигнализация':
		$color='class="w3-blue"';
		break;
		case 'Часы':
		$color='class="w3-violet"';
		break;
		case 'Телефон':
		$color='class="w3-lime2"';
		break;
		case 'Земля':
		$color='class="w3-olive"';
		break;
		case 'Обрыв':
		$color='class="w3-red"';
		break;
		case 'Свободный':
		$color='class="w3-yellow"';
		break;
		case 'Сирена':
		$color='class="w3-navy"';
		break;
		default:
		$color='';
		break;
	}
	return $color;
}

//Шапка таблиц по krossdata
function TheadKrossdata()
{
	$output='';
	$output.='
	<table class="table table-bordered table-hover">
	<thead>
	<tr>
	<th>Данные</th>
	<th>Распределение</th>
	<th>Номер</th>
	<th>Имя абонента</th>
	<th>Тип</th>
	<th>Комментарии</th>
	<th>Площадка</th>
	</tr>
	</thead><tbody id="myTable">';
	return $output;
}
function TbodyKrossdata($row, $color)
{
	$output='';
	$output .= '<tr '.$color.'>
	<td  class="edit_data"  data-subid="'.$row["sub_id"].'" data-idxxx="'.$row["data"].'" data-idarea="'.$row["area_name"].'" title="Редактировать?"><b>'.$row["data"].' </b><span class="glyphicon glyphicon-edit"></span></td>
	<td>'.$row["raspred_name"].'</td>
	<td class="data-number" data-number="'.$row["data"].'" data-idnumber="'.$row["number"].'" title="Быстрый поиск по номеру: '.$row["number"].'">'.$row["number"].' <span class="glyphicon glyphicon-search"></span></td>
	<td class="data-name" data-sub="'.$row["sub_name"].'" data-name="'.$row["data"].'" title="ID абонента-'.$row["sub_id"].'" data-idname="'.$row["sub_name"].'">'.$row["sub_name"].'</td>
	<td data-type="'.$row["data"].'" >'.$row["type_name"].'</td>
	<td>'.$row["comment"].'</td>
	<td>'.$row["area_name"].'</td>
	</tr>';
	return $output;
}



function OutputTheadCatalog()
{
  # code...
	$outputThead="";//Шапка справочника
	$outputThead='
	<table class="table table-bordered table-hover"> 
	<thead><tr>
	<th>ID</th>
	<th>Абонент</th>
	<th>Номер</th>
	<!--th>Городской</th-->
	<th>Управление</th>
	<th>Отдел/Бюро</th>
	<th>Кабинет</th>
	<th>Филиал</th>
	</tr></thead>';
	return $outputThead;
}
function OutputTbodyCatalog($row){
	$outputTbody='';
	$outputTbody .='<tbody>';
	if (($row["visibility"])=="1"){
		$outputTbody .='<tr>';
	}
	else {
		$outputTbody .='<tr style="background:  #FF4500">';
	}
	$outputTbody .='<td class="red_modal" data-sub="'.$row["sub_name"].'" data-id="'.$row["id"].'" data-subid="'.$row["sub_id"].'">'.$row["id"].'<span class="glyphicon glyphicon-edit"></span></td>
	<td class="data-name" data-idname="'.$row["sub_name"].'" data-sub="'.$row["sub_name"].'" data-subid="'.$row["sub_id"].'" data-catalogid="'.$row["id"].'" title="ID абонента-'.$row["sub_id"].'">'.$row["sub_name"].'</td>
	<td class="data-number" data-idnumber="'.$row["vnutr"].'">'.$row["vnutr"].'</td>
	<!--td>'.$row["city"].'</td-->
	<td>'.$row["unit_name"].'</td>
	<td>'.$row["department_name"].'</td>
	<td>'.$row["cabinet"].'</td>
	<td>'.$row["filial_name"].'</td>
	</tr>';
	return $outputTbody;
}
function BeansNull($catalogBeans, $searchString){
	$output='';
	$output='<br><div class="alert alert-danger">
	Информация по : <strong>'.$searchString.'</strong><br>Отсутствует в справочнике<hr><button type="button" class="btn btn-primary" onclick="catalogAdd()">Добавить абонента в справочник</button></div>';
	return $output;
}
?>