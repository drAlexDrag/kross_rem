<?php
require 'connect.php';
$output = '';
$area=R::getAll('SELECT * FROM type ORDER BY id');
$output = '<div>Необходимо выбрать тип связи, который будет присвоен данным после выполнения операции</div><hr>';
$output .= '<div><select class="form-control" size="1" name="param_type" id="param_type" style="color: #000; font-size: 16px; font-weight: 900;" >';
 foreach ($area as $row ){
  $output .= '<option data-id="'.$row["id"].'" value="'.$row["type_name"].'" >'.$row["type_name"].'</option>';
 }
$output .= '</select></div><hr>';
$output .= '<div><button type="button" class="btn btn-danger btn-block" onclick="confirmDataClear()" name="buttonconfirmDataClear" id="buttonconfirmDataClear">Очистить</button>
<button type="button" class="btn btn-default btn-block" onclick="off()" >Отмена</button></div>';
echo $output;
?>