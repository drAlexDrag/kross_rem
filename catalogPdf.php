<?php
// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';
require 'connect.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();
$output='';
// $print_out ='<h1 style="text-align: center">Заголовок</h1><br>';
// Write some HTML code:

$beansunit = R::getAll('SELECT * FROM unit WHERE unit_name IS NOT NULL AND id<>1 ORDER BY unit_name');
  foreach($beansunit as $rowunit)
 {
     $outputunit .='<h1>'.$rowunit["unit_name"].'</h1>';
    


$beans=R::getAll('SELECT DISTINCT department.id, department.department_name FROM catalog
    INNER JOIN unit ON catalog.unit_id = unit.id
    INNER JOIN department ON catalog.department_id = department.id
    WHERE unit.id=? ORDER BY department.department_name', [$rowunit["id"]]);
foreach($beans as $row){
	$dep[]=$row['id'];
}
// var_dump($dep);
// 
foreach ($dep as $rowdep){
$beans=R::getAll('SELECT catalog.id, sub.sub_name, catalog.vnutr, catalog.city, unit.unit_name, department.department_name, catalog.cabinet, filial.filial_name, catalog.visibility
    FROM catalog
    INNER JOIN sub ON catalog.sub_id = sub.id
    INNER JOIN unit ON catalog.unit_id = unit.id
    INNER JOIN department ON catalog.department_id = department.id
    INNER JOIN filial ON catalog.filial_id = filial.id
    WHERE unit.id=? AND department.id=? AND visibility NOT IN ("0") ORDER BY weight DESC', [62, $rowdep]);

$output_department .= '<div style="width: 100%">
    <table style="width: 100%">
        <tr>
            <th style="width: 80%">Абонент</th>
            <th style="width: 20%">Телефон</th>
        </tr>';
                foreach($beans as $row)
 {
           $output_department .= '
        <tr>
            <td>'.$row["sub_name"].'</td>
            <td>'.$row["vnutr"].'</td>
        </tr>';
         }
 $output_department .= '</table></div>';
 $output.='<h2 style="color: blue">'.$row["department_name"].'</h2>';
 $output.=$output_department;
 $output_department='';

}

}
// unset($dep);
$print_out ='<h1 style="text-align: center">'.$row['unit_name'].'</h1><br>';
$print_out.=$output;
// $mpdf->SetHeader($row['unit_name']);
$mpdf->SetFooter($row['unit_name']);
$mpdf->WriteHTML($print_out);
// Output a PDF file directly to the browser
$mpdf->Output();
// echo  $output;

?>