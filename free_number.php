<?php
//free number search
require 'connect.php';
$phonetype=$_POST["phonetype"];
// echo ($phonetype);
$output = '';
$number=R::getAll('SELECT * FROM '.$phonetype.' WHERE free_flag="0" ORDER BY number_name');
// $numOfnumber = R::count( ''.$phonetype.'' );

  $output .= '<div class="container box">
   <h1 align="center">Свободные номера</h1>
   <br />
   <div class="table-responsive">
    <div id="alert_message"></div>
    <table id="user_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>Номер</th>
       <th>Комментарий</th>
 
      </tr>

     </thead>';
      foreach ($number as $row ){
  $output .= '<tr><td>'.$row["number_name"].'</td><td>'.$row["comment"].'</td></tr>';
 }
     
    $output .= '</table>
   </div>
  </div>';
echo $output;
// echo('<p id="numOfnumber" hidden>'.$numOfnumber.'</p>');
?>