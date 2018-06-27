<?php

/*
  An Example PDF Report Using FPDF
  by Matt Doyle

  From "Create Nice-Looking PDFs with PHP and FPDF"
  http://www.elated.com/articles/create-nice-looking-pdfs-php-fpdf/
*/
define('FPDF_FONTPATH', 'fonts/');
require_once( "fpdf/fpdf.php" );
require 'connect.php';

// ГђВ Г‘Е“ГђВ Г‚В°ГђВЎГўв‚¬ВЎГђВ Г‚В°ГђВ Г‚В»ГђВ Г‘вЂў ГђВ Г‘вЂќГђВ Г‘вЂўГђВ ГђвЂ¦ГђВЎГўв‚¬ЕѕГђВ Г‘вЂГђВ Г‘вЂ“ГђВЎГ‘вЂњГђВЎГђвЂљГђВ Г‚В°ГђВЎГўв‚¬В ГђВ Г‘вЂГђВ Г‘вЂ
$textColour = array( 0, 0, 0 );
$headerColour = array( 100, 100, 100 );
$tableHeaderTopTextColour = array( 255, 255, 255 );
$tableHeaderTopFillColour = array( 125, 152, 179 );
$tableHeaderTopProductTextColour = array( 0, 0, 0 );
$tableHeaderTopProductFillColour = array( 143, 173, 204 );
$tableHeaderLeftTextColour = array( 99, 42, 57 );
$tableHeaderLeftFillColour = array( 184, 207, 229 );
$tableBorderColour = array( 50, 50, 50 );
$tableRowFillColour = array( 213, 170, 170 );
$reportName = "����������";
$reportNameYPos = 160;
$logoFile = "widget-company-logo.png";
$logoXPos = 50;
$logoYPos = 108;
$logoWidth = 110;
$columnLabels = array( "Q1" );
$area=R::getAll('SELECT catalog.id, sub.sub_name, catalog.vnutr, catalog.city, unit.unit_name, department.department_name, catalog.cabinet, filial.filial_name, catalog.visibility
    FROM catalog
    INNER JOIN sub ON catalog.sub_id = sub.id
    INNER JOIN unit ON catalog.unit_id = unit.id
    INNER JOIN department ON catalog.department_id = department.id
    INNER JOIN filial ON catalog.filial_id = filial.id
    WHERE unit.id=? AND department.id=1 AND visibility NOT IN ("0") ORDER BY weight DESC', [4]);
foreach ($area as $row){
  // $rowLabels[]=$row["area_name"];
  $rowLabels[]=iconv('UTF-8', 'cp1251', $row["sub_name"]);
  $fg=number_format($row["vnutr"]);
  $data[]=$fg;//iconv('UTF-8', 'cp1251', $row["vnutr"]);
  
}
//var_dump($data[0]);
// $rowLabels = array( "SupaWidget", "WonderWidget", "MegaWidget", "HyperWidget" );
$chartXPos = 20;
$chartYPos = 250;
$chartWidth = 160;
$chartHeight = 80;
$chartXLabel = "Справочник";
// $chartXLabel = iconv('UTF-8', 'cp1251', "");
$chartYLabel = "2009 Sales";
$chartYStep = 20000;

$chartColours = array(
                  array( 255, 100, 100 ),
                  array( 100, 255, 100 ),
                  array( 100, 100, 255 ),
                  array( 255, 255, 100 ),
                );

// $data = array(
//           array( 9940, 10100, 9490, 11730 ),
//           array( 19310, 21140, 20560, 22590 ),
//           array( 25110, 26260, 25210, 28370 ),
//           array( 27650, 24550, 30040, 31980 ),
//         );

// ГђВ Г‘в„ўГђВ Г‘вЂўГђВ ГђвЂ¦ГђВ Г‚ВµГђВЎГўв‚¬В  ГђВ Г‘вЂќГђВ Г‘вЂўГђВ ГђвЂ¦ГђВЎГўв‚¬ЕѕГђВ Г‘вЂГђВ Г‘вЂ“ГђВЎГ‘вЂњГђВЎГђвЂљГђВ Г‚В°ГђВЎГўв‚¬В ГђВ Г‘вЂГђВ Г‘вЂ


/**
  ГђВ ГђЕЅГђВ Г‘вЂўГђВ Г‚В·ГђВ Г’вЂГђВ Г‚В°ГђВ Г‚ВµГђВ Г‘Лњ ГђВЎГўв‚¬ЕЎГђВ Г‘вЂГђВЎГўв‚¬ЕЎГђВЎГ‘вЂњГђВ Г‚В»ГђВЎГђЕ ГђВ ГђвЂ¦ГђВЎГ‘вЂњГђВЎГђвЂ№ ГђВЎГђЖ’ГђВЎГўв‚¬ЕЎГђВЎГђвЂљГђВ Г‚В°ГђВ ГђвЂ¦ГђВ Г‘вЂГђВЎГўв‚¬В ГђВЎГ‘вЂњ
**/

$pdf = new FPDF( 'P', 'mm', 'A4' );
$pdf->AddFont('ArialMT', '', 'arial.php');
$pdf->AddFont('Arial-BoldMT', '', 'arialbd.php');
$pdf->AddFont('Arial-ItalicMT', '', 'ariali.php');
$pdf->AddFont('Arial-BoldItalicMT', '', 'arialbi.php');
$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
$pdf->AddPage();

// ГђВ Гўв‚¬ВєГђВ Г‘вЂўГђВ Г‘вЂ“ГђВ Г‘вЂўГђВЎГўв‚¬ЕЎГђВ Г‘вЂГђВ Г‘вЂ”
// $pdf->Image( $logoFile, $logoXPos, $logoYPos, $logoWidth );

// ГђВ Г‘Е“ГђВ Г‚В°ГђВ Г‚В·ГђВ ГђвЂ ГђВ Г‚В°ГђВ ГђвЂ¦ГђВ Г‘вЂГђВ Г‚Вµ ГђВ Г‘вЂўГђВЎГўв‚¬ЕЎГђВЎГўв‚¬ВЎГђВ Г‚ВµГђВЎГўв‚¬ЕЎГђВ Г‚В°
$pdf->SetFont('ArialMT', '', 24);
$pdf->Ln( $reportNameYPos );
$pdf->Cell( 0, 15, $reportName, 0, 0, 'C' );


/**
  ГђВ ГђЕЅГђВ Г‘вЂўГђВ Г‚В·ГђВ Г’вЂГђВ Г‚В°ГђВ Г‚ВµГђВ Г‘Лњ ГђВ Г‘вЂќГђВ Г‘вЂўГђВ Г‚В»ГђВ Г‘вЂўГђВ ГђвЂ¦ГђВЎГўв‚¬ЕЎГђВ Г‘вЂГђВЎГўв‚¬ЕЎГђВЎГ‘вЂњГђВ Г‚В», ГђВ Г‚В·ГђВ Г‚В°ГђВ Г‘вЂ“ГђВ Г‘вЂўГђВ Г‚В»ГђВ Г‘вЂўГђВ ГђвЂ ГђВ Г‘вЂўГђВ Г‘вЂќ ГђВ Г‘вЂ ГђВ ГђвЂ ГђВ ГђвЂ ГђВ Г‘вЂўГђВ Г’вЂГђВ ГђвЂ¦ГђВЎГўв‚¬В№ГђВ ГўвЂћвЂ“ ГђВЎГўв‚¬ЕЎГђВ Г‚ВµГђВ Г‘вЂќГђВЎГђЖ’ГђВЎГўв‚¬ЕЎ
**/

$pdf->AddPage();
$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetFont('ArialMT', '', 17);
$pdf->Cell( 0, 15, $reportName, 0, 0, 'C' );
$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
$pdf->SetFont('ArialMT', '', 20);
$pdf->Write( 19, "���� �������������� ��������� PDF ������" );
$pdf->Ln( 16 );
$pdf->SetFont('ArialMT', '', 12);
$pdf->Write( 6, "Despite the economic downturn, WidgetCo had a strong year. Sales of the HyperWidget in particular exceeded expectations. The fourth quarter was generally the best performing; this was most likely due to our increased ad spend in Q3." );
$pdf->Ln( 12 );
$pdf->Write( 6, "2010 is expected to see increased sales growth as we expand into other countries." );


/**
  ГђВ ГђЕЅГђВ Г‘вЂўГђВ Г‚В·ГђВ Г’вЂГђВ Г‚В°ГђВ Г‚ВµГђВ Г‘Лњ ГђВЎГўв‚¬ЕЎГђВ Г‚В°ГђВ Г‚В±ГђВ Г‚В»ГђВ Г‘вЂГђВЎГўв‚¬В ГђВЎГ‘вЂњ
**/

$pdf->SetDrawColor( $tableBorderColour[0], $tableBorderColour[1], $tableBorderColour[2] );
$pdf->Ln( 15 );

// ГђВ ГђЕЅГђВ Г‘вЂўГђВ Г‚В·ГђВ Г’вЂГђВ Г‚В°ГђВ Г‚ВµГђВ Г‘Лњ ГђВЎГђЖ’ГђВЎГўв‚¬ЕЎГђВЎГђвЂљГђВ Г‘вЂўГђВ Г‘вЂќГђВЎГ‘вЂњ ГђВ Г‚В·ГђВ Г‚В°ГђВ Г‘вЂ“ГђВ Г‘вЂўГђВ Г‚В»ГђВ Г‘вЂўГђВ ГђвЂ ГђВ Г‘вЂќГђВ Г‘вЂўГђВ ГђвЂ 
$pdf->SetFont( 'Arial', 'B', 15 );

// ГђВ ГђвЂЎГђВЎГўв‚¬ВЎГђВ Г‚ВµГђВ ГўвЂћвЂ“ГђВ Г‘вЂќГђВ Г‚В° "PRODUCT"
$pdf->SetTextColor( $tableHeaderTopProductTextColour[0], $tableHeaderTopProductTextColour[1], $tableHeaderTopProductTextColour[2] );
$pdf->SetFillColor( $tableHeaderTopProductFillColour[0], $tableHeaderTopProductFillColour[1], $tableHeaderTopProductFillColour[2] );
$pdf->Cell( 90, 12, " PRODUCT", 1, 0, 'L', true );

// ГђВ Г‘вЂєГђВЎГђЖ’ГђВЎГўв‚¬ЕЎГђВ Г‚В°ГђВ Г‚В»ГђВЎГђЕ ГђВ ГђвЂ¦ГђВЎГўв‚¬В№ГђВ Г‚Вµ ГђВЎГђВЏГђВЎГўв‚¬ВЎГђВ Г‚ВµГђВ ГўвЂћвЂ“ГђВ Г‘вЂќГђВ Г‘вЂ ГђВ Г‚В·ГђВ Г‚В°ГђВ Г‘вЂ“ГђВ Г‘вЂўГђВ Г‚В»ГђВ Г‘вЂўГђВ ГђвЂ ГђВ Г‘вЂќГђВ Г‘вЂўГђВ ГђвЂ 
$pdf->SetTextColor( $tableHeaderTopTextColour[0], $tableHeaderTopTextColour[1], $tableHeaderTopTextColour[2] );
$pdf->SetFillColor( $tableHeaderTopFillColour[0], $tableHeaderTopFillColour[1], $tableHeaderTopFillColour[2] );

for ( $i=0; $i<count($columnLabels); $i++ ) {
  $pdf->Cell( 90, 12, $columnLabels[$i], 1, 0, 'C', true );
}

$pdf->Ln( 12 );

// ГђВ ГђЕЅГђВ Г‘вЂўГђВ Г‚В·ГђВ Г’вЂГђВ Г‚В°ГђВ Г‚ВµГђВ Г‘Лњ ГђВЎГђЖ’ГђВЎГўв‚¬ЕЎГђВЎГђвЂљГђВ Г‘вЂўГђВ Г‘вЂќГђВ Г‘вЂ ГђВЎГђЖ’ ГђВ Г’вЂГђВ Г‚В°ГђВ ГђвЂ¦ГђВ ГђвЂ¦ГђВЎГўв‚¬В№ГђВ Г‘ЛњГђВ Г‘вЂ

$fill = false;
$row = 0;
// var_dump($data[0]);
foreach ( $data as &$dataRow ) {

  // Create the left header cell
  $pdf->SetFont('ArialMT', '', 12);
  $pdf->SetTextColor( $tableHeaderLeftTextColour[0], $tableHeaderLeftTextColour[1], $tableHeaderLeftTextColour[2] );
  $pdf->SetFillColor( $tableHeaderLeftFillColour[0], $tableHeaderLeftFillColour[1], $tableHeaderLeftFillColour[2] );
  $pdf->Cell( 90, 12, " " . $rowLabels[$row], 1, 0, 'L', $fill );

  // Create the data cells
  $pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
  $pdf->SetFillColor( $tableRowFillColour[0], $tableRowFillColour[1], $tableRowFillColour[2] );
  $pdf->SetFont('ArialMT', '', 12);

  for ( $i=0; $i<count($columnLabels); $i++ ) {
    $pdf->Cell( 90, 12, ( ( $dataRow[$i] ) ), 1, 0, 'C', $fill );
  }

  $row++;
  $fill = !$fill;
  $pdf->Ln( 12 );
}
// var_dump($dataRow[0]);

/***
  ГђВ ГђЕЅГђВ Г‘вЂўГђВ Г‚В·ГђВ Г’вЂГђВ Г‚В°ГђВ Г‚ВµГђВ Г‘Лњ ГђВ Г‘вЂ“ГђВЎГђвЂљГђВ Г‚В°ГђВЎГўв‚¬ЕѕГђВ Г‘вЂГђВ Г‘вЂќ
***/

// ГђВ Гўв‚¬в„ўГђВЎГўв‚¬В№ГђВЎГўв‚¬ВЎГђВ Г‘вЂГђВЎГђЖ’ГђВ Г‚В»ГђВЎГђВЏГђВ Г‚ВµГђВ Г‘Лњ ГђВ Г‘ЛњГђВ Г‚В°ГђВЎГђЖ’ГђВЎГўвЂљВ¬ГђВЎГўв‚¬ЕЎГђВ Г‚В°ГђВ Г‚В± ГђВ Г‘вЂ”ГђВ Г‘вЂў ГђВ Г‘вЂўГђВЎГђЖ’ГђВ Г‘вЂ X
// $xScale = count($rowLabels) / ( $chartWidth - 40 );

// // ГђВ Гўв‚¬в„ўГђВЎГўв‚¬В№ГђВЎГўв‚¬ВЎГђВ Г‘вЂГђВЎГђЖ’ГђВ Г‚В»ГђВЎГђВЏГђВ Г‚ВµГђВ Г‘Лњ ГђВ Г‘ЛњГђВ Г‚В°ГђВЎГђЖ’ГђВЎГўвЂљВ¬ГђВЎГўв‚¬ЕЎГђВ Г‚В°ГђВ Г‚В± ГђВ Г‘вЂ”ГђВ Г‘вЂў ГђВ Г‘вЂўГђВЎГђЖ’ГђВ Г‘вЂ Y

// $maxTotal = 0;

// foreach ( $data as $dataRow ) {
//   $totalSales = 0;
//   foreach ( $dataRow as $dataCell ) $totalSales += $dataCell;
//   $maxTotal = ( $totalSales > $maxTotal ) ? $totalSales : $maxTotal;
// }

// $yScale = $maxTotal / $chartHeight;

// // ГђВ Гўв‚¬в„ўГђВЎГўв‚¬В№ГђВЎГўв‚¬ВЎГђВ Г‘вЂГђВЎГђЖ’ГђВ Г‚В»ГђВЎГђВЏГђВ Г‚ВµГђВ Г‘Лњ ГђВЎГўвЂљВ¬ГђВ Г‘вЂГђВЎГђвЂљГђВ Г‘вЂГђВ ГђвЂ¦ГђВЎГ‘вЂњ ГђВЎГђЖ’ГђВЎГўв‚¬ЕЎГђВ Г‘вЂўГђВ Г‚В»ГђВ Г‚В±ГђВЎГўв‚¬В ГђВ Г‚В°
// $barWidth = ( 1 / $xScale ) / 1.5;

// // ГђВ Гўв‚¬ВќГђВ Г‘вЂўГђВ Г‚В±ГђВ Г‚В°ГђВ ГђвЂ ГђВ Г‚В»ГђВЎГђВЏГђВ Г‚ВµГђВ Г‘Лњ ГђВ Г‘вЂўГђВЎГђЖ’ГђВ Г‘вЂ:

// $pdf->SetFont( 'Arial', '', 10 );

// // ГђВ Г‘вЂєГђВЎГђЖ’ГђВЎГђЕ  X
// $pdf->Line( $chartXPos + 30, $chartYPos, $chartXPos + $chartWidth, $chartYPos );

// for ( $i=0; $i < count( $rowLabels ); $i++ ) {
//   $pdf->SetXY( $chartXPos + 40 +  $i / $xScale, $chartYPos );
//   $pdf->Cell( $barWidth, 10, $rowLabels[$i], 0, 0, 'C' );
// }

// // ГђВ Г‘вЂєГђВЎГђЖ’ГђВЎГђЕ  Y
// $pdf->Line( $chartXPos + 30, $chartYPos, $chartXPos + 30, $chartYPos - $chartHeight - 8 );

// for ( $i=0; $i <= $maxTotal; $i += $chartYStep ) {
//   $pdf->SetXY( $chartXPos + 7, $chartYPos - 5 - $i / $yScale );
//   $pdf->Cell( 20, 10, '$' . number_format( $i ), 0, 0, 'R' );
//   $pdf->Line( $chartXPos + 28, $chartYPos - $i / $yScale, $chartXPos + 30, $chartYPos - $i / $yScale );
// }

// // ГђВ Гўв‚¬ВќГђВ Г‘вЂўГђВ Г‚В±ГђВ Г‚В°ГђВ ГђвЂ ГђВ Г‚В»ГђВЎГђВЏГђВ Г‚ВµГђВ Г‘Лњ ГђВ Г‘ЛњГђВ Г‚ВµГђВЎГўв‚¬ЕЎГђВ Г‘вЂќГђВ Г‘вЂ ГђВ Г‘вЂўГђВЎГђЖ’ГђВ Г‚ВµГђВ ГўвЂћвЂ“
// $pdf->SetFont('ArialMT', '', 12);
// $pdf->SetXY( $chartWidth / 2 + 20, $chartYPos + 8 );
// $pdf->Cell( 30, 10, $chartXLabel, 0, 0, 'C' );
// $pdf->SetXY( $chartXPos + 7, $chartYPos - $chartHeight - 12 );
// $pdf->Cell( 20, 10, $chartYLabel, 0, 0, 'R' );

// // ГђВ ГђЕЅГђВ Г‘вЂўГђВ Г‚В·ГђВ Г’вЂГђВ Г‚В°ГђВ Г‚ВµГђВ Г‘Лњ ГђВЎГђЖ’ГђВЎГўв‚¬ЕЎГђВ Г‘вЂўГђВ Г‚В»ГђВ Г‚В±ГђВЎГўв‚¬В ГђВЎГўв‚¬В№ ГђВ Г‘вЂ“ГђВЎГђвЂљГђВ Г‚В°ГђВЎГўв‚¬ЕѕГђВ Г‘вЂГђВ Г‘вЂќГђВ Г‚В°
// $xPos = $chartXPos + 40;
// $bar = 0;

// foreach ( $data as $dataRow ) {

//   // ГђВ Гўв‚¬в„ўГђВЎГўв‚¬В№ГђВЎГўв‚¬ВЎГђВ Г‘вЂГђВЎГђЖ’ГђВ Г‚В»ГђВЎГђВЏГђВ Г‚ВµГђВ Г‘Лњ ГђВЎГђЖ’ГђВЎГ‘вЂњГђВ Г‘ЛњГђВ Г‘ЛњГђВ Г‚В°ГђВЎГђвЂљГђВ ГђвЂ¦ГђВ Г‘вЂўГђВ Г‚Вµ ГђВ Г‚В·ГђВ ГђвЂ¦ГђВ Г‚В°ГђВЎГўв‚¬ВЎГђВ Г‚ВµГђВ ГђвЂ¦ГђВ Г‘вЂГђВ Г‚Вµ ГђВ Г’вЂГђВ Г‚В»ГђВЎГђВЏ ГђВ Г‘вЂ”ГђВЎГђвЂљГђВ Г‘вЂўГђВ Г’вЂГђВЎГ‘вЂњГђВ Г‘вЂќГђВЎГўв‚¬ЕЎГђВ Г‚В°
//   $totalSales = 0;
//   foreach ( $dataRow as $dataCell ) $totalSales += $dataCell;

//   // ГђВ Гўв‚¬в„ўГђВЎГўв‚¬В№ГђВ ГђвЂ ГђВ Г‘вЂўГђВ Г’вЂГђВ Г‘вЂГђВ Г‘Лњ ГђВЎГђЖ’ГђВЎГўв‚¬ЕЎГђВ Г‘вЂўГђВ Г‚В»ГђВ Г‚В±ГђВ Г‚ВµГђВЎГўв‚¬В 
//   $colourIndex = $bar % count( $chartColours );
//   $pdf->SetFillColor( $chartColours[$colourIndex][0], $chartColours[$colourIndex][1], $chartColours[$colourIndex][2] );
//   $pdf->Rect( $xPos, $chartYPos - ( $totalSales / $yScale ), $barWidth, $totalSales / $yScale, 'DF' );
//   $xPos += ( 1 / $xScale );
//   $bar++;
// }


/***
  ГђВ Гўв‚¬в„ўГђВЎГўв‚¬В№ГђВ ГђвЂ ГђВ Г‘вЂўГђВ Г’вЂГђВ Г‘вЂГђВ Г‘Лњ PDF
***/

$pdf->Output( "report.pdf", "I" );

?>

