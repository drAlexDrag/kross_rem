<?php
require 'connect.php';
// require_once "phpdebug/phpdebug.php";//вывод в консоль
$data=$_POST;
$idinput=$_POST["idinput"];
$query=$_POST["query"];
$tablename=$_POST["tablename"];
$tablename2=$tablename.'_id';

// if(($_POST["idinput"])==!null)
// {$result=R::getAll( 'SELECT * FROM '.$tablename.' ORDER BY id');}
// else {}
// if ($tablename=="number") {
//   # code...
// }
$columnname=$_POST["columnname"];
$name = $_POST['name'];
$output = '';
// $debug = new PHPDebug();
// $debug->debug("Очень простое сообщение на консоль", null, LOG);
// $debug->debug("Очень простое сообщение на консоль2", null, LOG);
if(($_POST["query"])!=="start")
{
if (is_numeric($query)) {
  $result = R::getAll( 'SELECT * FROM '.$tablename.' WHERE id="'.$query.'"' );
  $resultreturt = R::getAll( 'SELECT * FROM '.$tablename.' WHERE id="'.$query.'
   " ' ); } else{
  $result = R::getAll( 'SELECT * FROM '.$tablename.' WHERE '.$columnname.' LIKE \'%'.$query.'%\' ' );
  $resultreturt = R::getAll( 'SELECT '.$columnname.' FROM '.$tablename.' WHERE '.$columnname.'="'.$query.'" ' );}
}
else
{

  $result=R::getAll( 'SELECT * FROM '.$tablename.' ORDER BY id LIMIT 200');
  $count=R::count($tablename);
}

 $output .= '
  <div class="table-responsive">
  
   <table class="table table bordered">
    <tr>
     <th>ID</th>
     <th>Name</th>
    </tr>
 ';
foreach ($result as $row) {
  $colorbeanscatalog=R::getAll( 'SELECT * FROM catalog WHERE '.$tablename2.'='.$row["id"].' ');
  $colorbeanskrossdata=R::getAll( 'SELECT * FROM krossdata WHERE '.$tablename2.'='.$row["id"].' ');
  if ($colorbeanscatalog==null & $colorbeanskrossdata==null){
  $output .= '
   <tr class="w3-red" title="Значение нигде не задействовано">
    <td>'.$row["id"].'</td>
    <td><a href="#" onclick="updateStaData(this)" data-nametable="'.$tablename.'" data-idname="'.$row['id'].'" data-value="'.$row[$columnname].'" data-idinput="'.$idinput.'" class="tablecolumn">'.$row[$columnname].'</a></td>
   </tr>
  ';
} 
elseif ($colorbeanscatalog==null) { 
    $output .= '
   <tr class="w3-orange" title="Значение задействовано в Кроссовом журнале. По Каталогу значение не задействовано">
    <td>'.$row["id"].'</td>
    <td><a href="#" onclick="updateStaData(this)" data-nametable="'.$tablename.'" data-idname="'.$row['id'].'" data-value="'.$row[$columnname].'" data-idinput="'.$idinput.'" class="tablecolumn">'.$row[$columnname].'</a></td>
   </tr>
  ';
  }
  elseif ($colorbeanskrossdata==null) {
   $output .= '
   <tr class="w3-khaki" title="Значение задействовано в Каталоге. По Кроссовому журналу значение не задействовано">
    <td>'.$row["id"].'</td>
    <td><a href="#" onclick="updateStaData(this)" data-nametable="'.$tablename.'" data-idname="'.$row['id'].'" data-value="'.$row[$columnname].'" data-idinput="'.$idinput.'" class="tablecolumn">'.$row[$columnname].'</a></td>
   </tr>
  ';
  }
  else{
   $output .= '
   <tr title="Значение задействовано в Кроссовом журнале и Каталоге">
    <td>'.$row["id"].'</td>
    <td><a href="#" onclick="updateStaData(this)" data-nametable="'.$tablename.'" data-idname="'.$row['id'].'" data-value="'.$row[$columnname].'" data-idinput="'.$idinput.'" class="tablecolumn">'.$row[$columnname].'</a></td>
   </tr>
  ';
  }
}
 
if ($result==null){$output=''; $output="<br><div class='alert alert-danger' id='alertInfo' name='alertInfo'>
  <strong>Alert!</strong> Совпадений не найдено. Добавте новое значение через меню БД</div>";
  echo $output;
} else {
  if ($resultreturt==null) {
    # code...
    $output2='<div id="resultreturt" hidden>Точного совпадения нет</div>';
  }
  $output.=$count;
  echo $output;
  echo $output2;
  $output2="";
}
?>
