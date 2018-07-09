<?php
require_once __DIR__ . '/vendor/autoload.php';
require 'connect.php';//подключение к базе
// Create an instance of the class
$mpdf = new \Mpdf\Mpdf();
$date = date('d/m/Y H:i:s', time());
$mpdf->AddPage();
$titul='Справочник телефонов ОАО Интеграл';
$mpdf->SetXY(100, 100);
$mpdf->SetFooter('Сформировано по состоянию на '.$date.'');
$mpdf->WriteText(1, 1, 'Справочник телефонов ОАО Интеграл');


$mpdf->Output();
  ?>