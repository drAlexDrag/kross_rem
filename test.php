<?php
require "connect.php";
// $data = R::load( 'krossdata', 22);
// var_dump($data);
// $array = [
//     "data_id"=>$data->id,
// 		"data_name"=>$data->data,
// 		"raspred"=>$data->raspred['raspred_name'],
// 		"number"=>$data->number,
// 		"sub"=>$data->sub_id,
// 		"type"=>$data->type['id'],
// 		"comment"=>$data->comment,
// 		"area"=>$data->area['id'],
// ];
// echo ("<br>dataId-".$array["data_id"]."<br>");
// echo ("data-".$array["data_name"]."<br>");
// echo ("number-".$array["number"]."<br>");
// echo ("sub-".$array["sub"]."<br>");
// echo ("type-".$array["type"]."<br>");
// echo ("comment-".$array["comment"]."<br>");
// echo ("area-".$array["area"]."<br>");
// $data=R::dispense('krossdata');
// 	$data->data=$dataKross;
// 	$data->number=$dataNumber;
// 	$data->comment=$dataComment;
// 	$data->raspred=R::load('raspred', $raspredId);
// 	$data->sub=R::load('sub', $subId);
// 	$data->type=R::load('type', $typeId);
// 	$data->area=R::load('area', $areaId);
// 	R::store($data);

?>

<?php

//Определение класса
class KrossData
{
    //Устанавливается значение по умолчанию
  // public $data = 1234;
	public $raspred = 1;
	public $number = "";
	public $sub = 1;
	public $type = 1;
	public $comment ="";
	public $area = 1;
	function showData($in){
		$data = R::load( 'krossdata', $in);
// var_dump($data);
$raspred=R::load('raspred', $data->raspred_id);
$sub=R::load('sub', $data->sub_id);
$type=R::load('type', $data->type_id);
$area=R::load('area', $data->area_id);
		$array = [
			"data_id"=>$data->id,
			"data_name"=>$data->data,
			"raspred"=>$raspred['raspred_name'],
			"number"=>$data->number,
			"sub"=>$sub['sub_name'],
			"type"=>$type['type_name'],
			"comment"=>$data->comment,
			"area"=>$area['area_name'],
		];
		echo $data['id'].'<br>';
		echo $data['data'].'<br>';
		echo $array['raspred'].'<br>';
		echo $data['number'].'<br>';
		echo $array['sub'].'<br>';
		echo $array['type'].'<br>';
		echo $data['comment'].'<br>';
		echo $array['area'].'<br>';
	}
	function newData(){

	}
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// if () {}
	KrossData::showData($_POST['data']);
	// echo $dataNumber['sub'];
}

// //Создание объекта кошки
// $krossData = new KrossData();

// echo $krossData->data .'<br>'; //Результат: Сиамская
// echo $krossData->type .'<br>';


// //Переопределяем породу
// $krossData->data = '22';
// $krossData->type = '3';
// echo $krossData->data .'<br>'; //Результат: Мейнкун
// echo $krossData->type .'<br>';


// //Создаем строковую переменную, содержащую имя
// //свойства. Значение этой переменной используется
// //для доступа к свойству объекта
// $data = 'data';
// echo $krossData->$data .'<br>'; //Результат: Мейнкун
// $krossData->number=KrossData::prt($krossData->$data);
// // $krossData->number=$krossData->prt($krossData->$data);
// echo $krossData->number .'<br>номер';
?>
<script>
	function newdata($bn) {
		// body...
		alert($bn);
	}
	// document.on('click', '#new',function(){
	// // $("#new")
	// alert("asd");});
</script>
<form action="/test.php" method="post"><input type="text" name="data"><button type="submit" id="show">Show Data</button></form>
<form><input type="text" name="newdata"><button onclick="newdata(123)">New Data</button></form>
