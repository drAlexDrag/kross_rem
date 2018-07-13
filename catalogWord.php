<?php
require_once 'vendor/autoload.php';
require 'connect.php';
require_once "phpdebug/phpdebug.php";//вывод в консоль
// $debug = new PHPDebug();//вывод в консоль
$phpWord = new \PhpOffice\PhpWord\PhpWord();
$sectionIntro = $phpWord->addSection();
$output = '';
$output_department = '';
$titul = '';
$date = date('d/m/Y H:i:s', time());
$phpWord->getSettings()->setHideGrammaticalErrors(true);
$phpWord->getSettings()->setHideSpellingErrors(true);
$properties = $phpWord->getDocInfo();
$properties->setCreator('Драгунов А.Н.');
$properties->setCompany('ОАО Интеграл');
$properties->setTitle('Справочник телефонов ОАО Интеграл');
$properties->setCreated(time());
////Стили
$paragraphStyleTit = array('align'=>'center', 'spaceBefore'=>3000);
$paragraphStyleTit2 = array('align'=>'center');
$fontStyleTit = array('color'=>'000000', 'size'=>34, 'bold'=>true);
$fontStyleTit2 = array('color'=>'000000', 'size'=>14, 'bold'=>true);

$fancyTableStyleName = 'Fancy Table';
$fancyTableStyle = array('borderSize' => 1, 'borderColor' => '006699', 'cellMargin' => 80, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
$fancyTableFirstRowStyle = array('borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF');
$fancyTableCellStyle = array('valign' => 'center');
$fancyTableCellBtlrStyle = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR);
$fancyTableFontStyle = array('bold' => true);
$phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
$fontStyleUnit = array('color'=>'0000ff', 'size'=>22, 'bold'=>true);
$fontStyleDepartment = array('color'=>'000000', 'size'=>16, 'bold'=>true);
$fontStyleLink = array('color'=>'0000ff', 'size'=>10, 'bold'=>true);
///Стили END

$sectionIntro->addText('Справочник телефонов', $fontStyleTit, $paragraphStyleTit);
$sectionIntro->addText('ОАО Интеграл', $fontStyleTit, $paragraphStyleTit2);
$sectionIntro->addText('Сформировано по состоянию на '.$date.'', $fontStyleTit2, $paragraphStyleTit2);
$beansunit = R::getAll('SELECT * FROM unit WHERE unit_name IS NOT NULL AND id<>1 ORDER BY unit_name');
$styleSection = array('marginLeft'=>1200, 'marginRight'=>1000, 'marginTop'=>1000, 'marginBottom'=>1000, 'borderLeftColor'=> '0000ff');

// $fancyTextRun = array('marginLeft'=>15200);
// $footer = $sectionIntro->addTextRun($fancyTextRun);
// $footer->addImage('images/pdf.png');

$sectionListUnit = $phpWord->addSection();
// $sectionListUnit
// $debug->debug("List управлений Start", null, LOG);

foreach($beansunit as $rowunit)
{
  // $debug->debug($rowunit["unit_name"], null, LOG);
  $textLink=str_replace(' ', '_', $rowunit["unit_name"]);
  $sectionListUnit->addLink($textLink, htmlspecialchars($rowunit["unit_name"], ENT_COMPAT, 'UTF-8'), null, null, true);
  $dataunit[] = array('id' =>$rowunit['id'] , 'unit_name' =>$rowunit["unit_name"]);

}
$sectionOutUnit = $phpWord->addSection($styleSection);//Одна секция для каждого управления
// $debug->debug("List управлений END", null, LOG);
// $debug->debug("Перебор управлепний для департаментов", null, LOG);
foreach ($dataunit as $valueunit) {
  // $sectionOutUnit = $phpWord->addSection($styleSection);//Новая секция для каждого управления
  $department_name="";
  $sectionOutUnit->addText($valueunit['unit_name'], $fontStyleUnit);
  $sectionOutUnit->addBookmark($valueunit['unit_name']);
  // $debug->debug("Имя управления ".$valueunit["unit_name"], null, LOG);
  $beansdep=R::getAll('SELECT DISTINCT department.id, department.department_name FROM catalog
    INNER JOIN unit ON catalog.unit_id = unit.id
    INNER JOIN department ON catalog.department_id = department.id
    WHERE unit.id=? AND visibility NOT IN ("0")  ORDER BY department.department_name', [$valueunit["id"]]);
  foreach($beansdep as $rowdep){
    // $debug->debug(" Имя департамента ".$rowdep["department_name"], null, LOG);
    $department_name=$rowdep["department_name"];
    $sectionOutUnit->addText($department_name, $fontStyleDepartment);

    $beans=R::getAll('SELECT catalog.id, sub.sub_name, catalog.vnutr, catalog.city, unit.unit_name, department.department_name, catalog.cabinet, filial.filial_name, catalog.visibility
      FROM catalog
      INNER JOIN sub ON catalog.sub_id = sub.id
      INNER JOIN unit ON catalog.unit_id = unit.id
      INNER JOIN department ON catalog.department_id = department.id
      INNER JOIN filial ON catalog.filial_id = filial.id
    WHERE unit.id=? AND department.id=? AND visibility NOT IN ("0") ORDER BY weight DESC', [$valueunit["id"], $rowdep['id']]);
    $table = $sectionOutUnit->addTable($fancyTableStyle);
    $table->addRow();
    $table->addCell(12000, $fancyTableCellStyle)->addText("Абонент", $fancyTableFontStyle);
    $table->addCell(2000, $fancyTableCellStyle)->addText("Телефон", $fancyTableFontStyle);
    foreach($beans as $row)
     { $table->addRow();
      $table->addCell(12000, $fancyTableCellStyle)->addText($row["sub_name"], $fancyTableFontStyle);
      $table->addCell(2000, $fancyTableCellStyle)->addText($row["vnutr"], $fancyTableFontStyle);
    }
  }
}

$date = date('d/m/Y');
 header("Content-Type: application/octet-stream");
 header('Content-Disposition: attachment; filename=Справочник телефонов за '.$date.'.docx');
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
// $objWriter->save('download/Catalog.docx');
$objWriter->save('php://output');
// $output='';
// $output= '<!DOCTYPE html>
// <html lang="en">
// <head>
// <meta charset="utf-8">
// <meta http-equiv="Cache-Control" content="no-cache" />
// <meta http-equiv="Cache-Control" content="max-age=3600, must-revalidate" />
// <meta name="viewport" content="width=device-width, initial-scale=1">
// <title>Справочник телефонов ОАО "Интеграл"</title>
// <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon"/>
// <link rel="stylesheet" href="/css/bootstrap.css" />
// <link rel="stylesheet" href="/css/mystyle.css" />
// <script src="/js/jquery-3.2.1.min.js"></script>
// <script src="/js/bootstrap.min.js"></script>
// <script>function countDownloads() {
//   $.ajax({
//     url: "/catalog/countdownloads.php",
//     cache: false,
//     dataType:"html",
//     success: function(data){
//     }
//     });
//   }
//   </script>
//   </head>
//   <body>
//   <div class="container-fluid">
//   <div class="col-sm-4"></div>
//   <div class="col-sm-4" style="margin-top: 10%;"><h2>Документ сформирован</h2><div>Нажмите <button type="button" class="btn"><a href="/download/Catalog.docx" onclick="countDownloads()">Сохранить</a></button></div>
//   </div>
//   <div class="col-sm-4"></div>
//   </div>
//   </body></html>';
//   echo ($date); 
//   echo ($output);
  ?>