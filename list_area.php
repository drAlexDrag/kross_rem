<?php
$output = '';
$area=R::getAll('SELECT * FROM area ORDER BY id');
$output = '<select class="form-control" size="1" name="param_area" id="param_area" onchange="fetchData(1)" style="color: #000; font-size: 16px; font-weight: 900;" >';
 foreach ($area as $row ){
  $output .= '<option data-id="'.$row["id"].'" value="'.$row["area_name"].'" >'.$row["area_name"].'</option>';
 }
$output .= '</select>';
echo $output;
?>