<?php
 //Выводим список площадок
// require_once 'connectcat.php';
 require_once 'tconnect.php';
 //echo $out;
 $output = '';
 // $query = "SELECT * FROM unit WHERE unit_name IS NOT NULL ORDER BY unit_name";
 $beans = R::getAll('SELECT * FROM unit WHERE unit_name IS NOT NULL AND id<>1 ORDER BY unit_name');

 // $result = mysqli_query($connect, $query);
 $output.='<ul>';
 // while($row = mysqli_fetch_array($result) and i<=10)
 // {
  foreach($beans as $row)
 {
 	 $output .='<li><a onclick="unitCatalog(this)" id="'.$row["unit_name"].'" style="color:blue; cursor: pointer;" data-id="'.$row["id"].'" name="'.$row["unit_name"].'">'.$row["unit_name"].'</a></li>';
 // }
 	}
 $output.='</ul>';
 echo $output;
 ?>