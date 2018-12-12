<?php
 //Выводим список площадок
 require_once '../connect.php';
 $output = '';
 $beans = R::getAll('SELECT * FROM unit WHERE unit_name IS NOT NULL AND id<>1 ORDER BY unit_name');
 $output.='<ul>';
  foreach($beans as $row)
 {
 	$output .='<li><a onclick="unitCatalog(this)" id="'.$row["id"].'" style="color:blue; cursor: pointer;" name="'.$row["unit_name"].'">'.$row["unit_name"].'</a></li>';
 	}
 $output.='</ul>';
 echo $output;
 ?>