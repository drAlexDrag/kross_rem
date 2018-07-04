<?php
require_once 'vendor/autoload.php';
require 'connect.php';
$phpWord = new \PhpOffice\PhpWord\PhpWord();
$section = $phpWord->addSection();

$output = '';
$output_department = '';
$titul = '';


$beansunit = R::getAll('SELECT * FROM unit WHERE unit_name IS NOT NULL AND id<>1 ORDER BY unit_name');

  foreach($beansunit as $rowunit)
 {

     $section->addListItem($rowunit["unit_name"]);

 }




// foreach ($dataunit as $valueunit) {

// $beansdep=R::getAll('SELECT DISTINCT department.id, department.department_name FROM catalog
//     INNER JOIN unit ON catalog.unit_id = unit.id
//     INNER JOIN department ON catalog.department_id = department.id
//     WHERE unit.id=?   ORDER BY department.department_name', [$valueunit]);
// foreach($beansdep as $rowdep){

// 	$dep[]=$row['id']; 

$beans=R::getAll('SELECT catalog.id, sub.sub_name, catalog.vnutr, catalog.city, unit.unit_name, department.department_name, catalog.cabinet, filial.filial_name, catalog.visibility
    FROM catalog
    INNER JOIN sub ON catalog.sub_id = sub.id
    INNER JOIN unit ON catalog.unit_id = unit.id
    INNER JOIN department ON catalog.department_id = department.id
    INNER JOIN filial ON catalog.filial_id = filial.id
    WHERE unit.id=? AND department.id=? AND visibility NOT IN ("0") ORDER BY weight DESC', [62, 1]);

$section->addText('Заголловок', $header);
$fancyTableStyleName = 'Fancy Table';
$fancyTableStyle = array('borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 80, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
$fancyTableFirstRowStyle = array('borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF');
$fancyTableCellStyle = array('valign' => 'center');
$fancyTableCellBtlrStyle = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR);
$fancyTableFontStyle = array('bold' => true);
$phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
$table = $section->addTable();
foreach($beans as $row){
// for ($r = 1; $r <= 1; $r++) {
    $table->addRow();
//     for ($c = 1; $c <= 1; $c++) {
    	
// $table->addCell(12000,  $fancyTableCellStyle)->addText("{$row["sub_name"]}", $fancyTableFontStyle);
// $table->addCell(2750,  $fancyTableCellStyle)->addText("{$row["vnutr"]}");
//     	}
        
//     }
    $table->addCell(2000, $fancyTableCellStyle)->addText($row["sub_name"], $fancyTableFontStyle);
$table->addCell(2000, $fancyTableCellStyle)->addText($row["vnutr"], $fancyTableFontStyle);
}

// $section->addText('Basic table', $header);

// $table = $section->addTable();
// for ($r = 1; $r <= 8; $r++) {
//     $table->addRow();
//     for ($c = 1; $c <= 2; $c++) {
//         $table->addCell(1750)->addText("Row {$r}, Cell {$c}");
//     }
// }
// $output_department .= '<div style="width: 100%">
//     <table style="width: 100%">
//         <tr>
//             <th style="width: 80%">Абонент</th>
//             <th style="width: 20%">Телефон</th>
//         </tr>';
 //                foreach($beans as $row)
 // {
 //           $output_department .= '
 //        <tr>
 //            <td>'.$row["sub_name"].'</td>
 //            <td>'.$row["vnutr"].'</td>
 //        </tr>';
 //         }
 // $output_department .= '</table></div>';
 // $output.='<h2 style="color: blue">'.$row["department_name"].'</h2>';
 // $output.=$output_department;
 // $output_department='';

// }
// $section->addText($row['unit_name'], $header);
// $output_unit.='<a name="'.$row['unit_name'].'"></a><h1 style="text-align: center">'.$row['unit_name'].'</h1><br>';
// $output_unit.=$output;
// $alloutput.=$output_unit;
// $output_unit='';
// $output='';

// }
// $date = date('d/m/Y H:i:s', time());
// $titul='<div><h1 style="text-align: center">Справочник телефонов ОАО Интеграл</h1><div><br>
// <p>Сформировано по состоянию на '.$date.'</p><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
// <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
// $titul.=$zagol;

// $print_out.=$titul;

// $print_out.=$alloutput;

// $myTextElement = $section->addText($print_out);
// $myTextElement->setFontStyle($fontStyle);
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('helloWorld.docx');
?>